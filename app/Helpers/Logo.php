<?php
namespace App\Helpers;


use Auth;
use App\Models\UserFiles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class Logo{
	public static function decodeFile($str=""){
		list($type, $data) = explode(';', $str);
		list(, $data)      = explode(',', $data);
		$data = base64_decode($data);

		$extension = explode('/', mime_content_type($str))[1];



		return ["data"=>$data, "extension"=>$extension];
	}
	
	
	public static function getRandName($ext=""){
		return Str::random(25).".".$ext;
	}

	public static function saveUserLogo($req) {
		$is_temp_user = 0;
		$decoded = self::decodeFile($req->logo);
		$file_name = "users_original_files/".Str::random(25).".".$decoded['extension'];

		$original_path = '';
		if($req->original) {
			$decoded_original = self::decodeFile($req->original);
			$original_file_name = "users_original_files/".Str::random(25).".".$decoded_original['extension'];

			$original_full_path = Storage::disk('public')->path($original_file_name);
			Storage::disk('public' )->put($original_file_name, $decoded_original['data']);

			$original_path = str_replace(Storage::disk('public')->path(""), "", $original_full_path);
		}
		
		$svg_full_path = Storage::disk('public')->path($file_name);
		$thumb_path = Storage::disk('public')->path("thumbnails");
		Storage::disk('public' )->put($file_name, $decoded['data']);
		
		$thumb = str_replace(Storage::disk('public')->path(""), "", self::convertSVGToPNG($svg_full_path, $thumb_path, 200));
		$user_id = Auth::id();
		if(!$user_id) {
			$is_temp_user = 1;
			$user_id = Str::random(10);
            Session::put('temp_user_id', $user_id);
		}
		
		UserFiles::create([
			"user_id"=>$user_id,
			"path"=>$svg_full_path,
			"relative_path"=>$thumb,
			"xtype"=>"svg",
			"original_path"=> $original_path,
			"category"=> $req->category | "",
			"is_temp_user"=>$is_temp_user
		]);

		return $file_name;
	}
	
	public static function convertSVGToPNG($file, $dest_folder, $w=0, $h=0){
		$fn = Str::random(25).".png";
		if(!is_dir($dest_folder)){
			mkdir($dest_folder);
		}
		$dest_file = "$dest_folder/$fn";
		$shell = "rsvg-convert --keep-image-data $file ".($w?" -w $w ":"").($h?" -h $h ":"")." -o $dest_file";
		#exit($shell);
		
		$x = shell_exec($shell);
		return $dest_file;
	}

	public static function convertSVGToPDF($file, $dest_folder, $w=0, $h=0){	
		$fn = Str::random(25).".pdf";
		$dest_file = "$dest_folder/$fn";
		$shell = "rsvg-convert -f pdf $file ".($w?" -w $w ":"").($h?" -h $h ":"")." -o $dest_file";
		$x = shell_exec($shell);
		return $dest_file;
//		"rsvg-convert -f pdf -o t.pdf t.svg"
	}
	
	
	public static function getUserArchive($price="free"){

        $user_id = Auth::id() ?? Session::get('temp_user_id');
        if($user_id){
        	$obj = UserFiles::where(["user_id"=>$user_id])->orderBy('id', 'desc')->first();
        }

		
		$temp_dir = Storage::disk('local')->path("/temp");
		if(!is_dir($temp_dir)){
			mkdir($temp_dir);
		}


		switch($price->price){
			case '':
			case 0:
			case 'free':
				//rsvg-convert ./test.svg -w 200 -o copy.png
				
				return Storage::disk('public')->url($obj->relative_path);
			break;
			
			default:
				$zp = "/premium_archives/".self::getRandName("zip");
				$png = self::convertSVGToPNG($obj->path, $temp_dir, 5000);
				$pdf = self::convertSVGToPDF($obj->path, $temp_dir, 500);
				$zip_file = Storage::disk('public')->path($zp);
				$zip_url = Storage::disk("public")->url($zp);

				$zip = new \ZipArchive();
				$zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
				$zip->addFile($png, "logo.png");
				$zip->addFile($pdf, "logo.pdf");				
				$zip->addFile($obj->path, "logo.svg");
				$zip->close();

				return $zip_url;
			break;
			
		}
	}
	
	public static function getUserLastLogo($user_id=0){
        if($user_id==0)
        return false; 
        
		$ses_id = Session::get('temp_user_id');
        $user_id = Auth::id() ?? Session::get('temp_user_id');
        if($ses_id && $user_id){
        	UserFiles::where(["user_id"=>$ses_id])->update(["user_id"=>$user_id]);
        }        
        if($user_id){
        	$obj = UserFiles::where(["user_id"=>$user_id])->orderBy('id', 'desc')->first();
        	return [
				"path"=>$obj->path,
				"url"=>Storage::disk('public')->url($obj->relative_path),
				"category"=>$obj->category,
				"original_url"=>Storage::disk('public')->url($obj->original_path)
			];
        }

        return false;
	}

}
