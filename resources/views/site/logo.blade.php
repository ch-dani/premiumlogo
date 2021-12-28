@extends('layouts.site2')

@section('title')
Logo
@endsection

@section('content')
<?php

 ?>

@if($admin_mode)
	<div class="admin_mode_header">
		<div class="ah_left">
			<span class="in_admin_mode attention">ADMIN MODE</span>
		</div>
		<div class="ah_center">
			<!-- <a href="#" class="dh_tool_btn create-tshirt-template">
				<img src="/site/img/icon-btn-tool-2.svg" alt="">
				Create T-Shirt template
			</a>
			<a href="#" class="dh_tool_btn create-tshirt-template">
				<img src="/site/img/icon-btn-tool-2.svg" alt="">
				Create T-Shirt template
			</a>

			<a href="#" class="dh_tool_btn create-tshirt-template">
				<img src="/site/img/icon-btn-tool-2.svg" alt="">
				Create T-Shirt template
			</a> -->
		</div>
		<div class="ah_right">
		</div>
	</div>
	
@endif
<script>
	var tshirt_template = false;
	@if(isset($template))
		tshirt_template = <?= json_encode($template) ?>
	@endif
</script>

<main>
    <section class="dashboard">
        <div class="overlay" id="preview_modal">
            <div class="popup popup_add_shape">
                <div class="header_popup">
                    <div class="header_popup_left">
                        <div class="header_popup_logo">
                            @php include(public_path('site/img/popup-logo.svg')) @endphp
                        </div>
                        <h4 class="popup_name">
                            Preview
                        </h4>
                    </div>
                    <div class="header_popup_right">
                        <a href="#" class="close_popup">
                            @php include(public_path('site/img/close-popup.svg')) @endphp
                        </a>
                    </div>
                </div>
                <div class="popup_content preview">
                    <div class="contnetnt_wrapper preview" id="previewModal"></div>
                </div>
            </div>
        </div>

        <div class="overlay" id="add_shape">
            <div class="popup popup_add_shape">
                <div class="header_popup">
                    <div class="header_popup_left">
                        <div class="header_popup_logo">
                            @php include(public_path('site/img/popup-logo.svg')) @endphp
                        </div>
                        <h4 class="popup_name">
                            Add Shape
                        </h4>
                    </div>
                    <div class="header_popup_right">
                        <a href="#" class="close_popup">
                            @php include(public_path('site/img/close-popup.svg')) @endphp
                        </a>
                    </div>
                </div>
                <div class="popup_content">
                    <div class="contnetnt_wrapper" id="shapeModal">
                        <div class="content_popup_items">

                            <div class="content_popup_row">
                                
                            </div>
                        </div>
                        <div class="popup_pagination">
                            <ul class="module__pagination"></ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="overlay" id="open_templates">
            <div class="popup popup_open_templates">
                <div class="header_popup">
                    <div class="header_popup_left">
                        <!-- <div class="header_popup_logo">
                            @php include(public_path('site/img/popup-logo.svg')) @endphp
                        </div> -->
                        <h4 class="popup_name"></h4>
                    </div>
                    <div class="header_popup_right">
                        <a href="#" class="close_popup">
                            @php include(public_path('site/img/close-popup.svg')) @endphp
                        </a>
                    </div>
                </div>
                <div class="popup_content">
                    <div class="contnetnt_wrapper" id="shapeModal">
                        <div class="content_popup_items">
                            <div class="content_popup_row"></div>
                        </div>

                        <div class="popup_pagination">
                            <ul class="module__pagination"></ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="overlay" id="add_icon">
            <div class="popup popup_add_icon">
                <div class="header_popup">
                    <div class="header_popup_left">
                        <div class="header_popup_logo">
                            @php include(public_path('site/img/popup-logo.svg')) @endphp
                        </div>
                        <h4 class="popup_name">
                            Add Icon
                        </h4>
                        <input type="text" placeholder="Search" id="searchIconVal" class="default_input item">
                        <a href="#" class="btn" id="searchIcon">
                            @php include(public_path('site/img/search.svg')) @endphp
                        </a>
                    </div>
                    <div class="header_popup_right">
                        <a href="#" class="close_popup">
                            @php include(public_path('site/img/close-popup.svg')) @endphp
                        </a>
                    </div>
                </div>
                <div class="popup_content">
                    <div class="contnetnt_wrapper" id="iconsModal">
                        <div class="content_popup_items">
                            <div class="content_popup_row">

                            </div>
                        </div>
                        {{--<div class="popup_pagination">
                            <ul class="module__pagination"></ul>
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="overlay" id="add_logo">
            <div class="popup popup_add_logo">
                <div class="header_popup">
                    <div class="header_popup_left">
                        <div class="header_popup_logo">
                            @php include(public_path('site/img/popup-logo.svg')) @endphp
                        </div>
                        <h4 class="popup_name">
                            Add Logo
                        </h4>
                    </div>
                    <div class="header_popup_right">
                        <a href="#" class="close_popup">
                            @php include(public_path('site/img/close-popup.svg')) @endphp
                        </a>
                    </div>
                </div>

                <div class="popup_content">
                    <div class="popup_sidebar">
                        <div class="burger_popup_sidebar">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M492,236H20c-11.046,0-20,8.954-20,20c0,11.046,8.954,20,20,20h472c11.046,0,20-8.954,20-20S503.046,236,492,236z" fill="#7B7B7B"></path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M492,76H20C8.954,76,0,84.954,0,96s8.954,20,20,20h472c11.046,0,20-8.954,20-20S503.046,76,492,76z" fill="#7B7B7B"></path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M492,396H20c-11.046,0-20,8.954-20,20c0,11.046,8.954,20,20,20h472c11.046,0,20-8.954,20-20
			C512,404.954,503.046,396,492,396z" fill="#7B7B7B"></path>
                                    </g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                            </svg>
                        </div>
                        <div class="all">
                            <h3>All Categories</h3>
                        </div>
                        <div class="categorie_list">
                            <ul></ul>
                        </div>

                    </div>

                    <div class="contnetnt_wrapper" id="logosModal">
                        <div class="content_popup_items">

                            <div class="content_popup_row">
                                
                            </div>
                        </div>
                        <div class="popup_pagination">
                            <ul class="module__pagination"></ul>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="dashboard_widget">
            <div class="widget_burger">
                @php include(public_path('site/img/arrow-left-next.svg')) @endphp
            </div>
            <h3 class="dashboard_widget_title">editor</h3>
            <div class="dashboard_widget_content">
                <div class="dropdown_wrapper" id="dropdownWidget">
                    <div class="dropdown_select">Dashboard Layers</div>
                    <div class="dropdown_option_wrapper">
                        <div class="dropdown_option">
                            @php include(public_path('site/img/icon-editor-option-1.svg')) @endphp
                            Shape Circle
                        </div>
                        <div class="dropdown_option">
                            @php include(public_path('site/img/icon-editor-option-1.svg')) @endphp
                            Shape Circle
                        </div>
                        <div class="dropdown_option">
                            @php include(public_path('site/img/icon-editor-option-1.svg')) @endphp
                            Shape Circle
                        </div>
                        <div class="dropdown_option">
                            @php include(public_path('site/img/icon-editor-option-1.svg')) @endphp
                            Shape Circle
                        </div>
                        <div class="dropdown_option">
                            @php include(public_path('site/img/icon-editor-option-1.svg')) @endphp
                            Shape Circle
                        </div>
                        <div class="dropdown_option">
                            @php include(public_path('site/img/icon-editor-option-1.svg')) @endphp
                            Shape Circle
                        </div>
                        <div class="dropdown_option">
                            @php include(public_path('site/img/icon-editor-option-1.svg')) @endphp
                            Shape Circle
                        </div>
                        <div class="dropdown_option">
                            @php include(public_path('site/img/icon-editor-option-1.svg')) @endphp
                            Shape Circle
                        </div>
                        <div class="dropdown_option">
                            @php include(public_path('site/img/icon-editor-option-1.svg')) @endphp
                            Shape Circle
                        </div>
                    </div>
                </div>

                <div class="textBar" style="display: none;">
                    <div class="mini_text_wrapper">
                        <div class="mini_dashboard_content">
                            <h4 class="mini_text">
                                logo
                            </h4>
                        </div>

                        <div class="font_wrapper">
                            <div class="dropdown_wrapper" id="miniText">
                                <div class="dropdown_select" style="white-space: nowrap;">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.4211 0H1.57895C0.706947 0 0 0.706947 0 1.57895V5.68316C0 6.55516 0.706947 7.2621 1.57895 7.2621C2.45095 7.2621 3.15789 6.55516 3.15789 5.68316V3.15789H8.42105V16.8421H5.98274C5.11074 16.8421 4.40379 17.5491 4.40379 18.4211C4.40379 19.2931 5.11074 20 5.98274 20H14.0173C14.8893 20 15.5962 19.2931 15.5962 18.4211C15.5962 17.5491 14.8893 16.8421 14.0173 16.8421H11.5789V3.15789H16.8421V5.68316C16.8421 6.55516 17.5491 7.2621 18.4211 7.2621C19.2931 7.2621 20 6.55516 20 5.68316V1.57895C20 0.706947 19.2931 0 18.4211 0Z" fill="#D5D5D5"></path>
                                    </svg>
                                    Open Sans
                                </div>
                                <div class="dropdown_option_wrapper">
                                    <div class="dropdown_option">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.4211 0H1.57895C0.706947 0 0 0.706947 0 1.57895V5.68316C0 6.55516 0.706947 7.2621 1.57895 7.2621C2.45095 7.2621 3.15789 6.55516 3.15789 5.68316V3.15789H8.42105V16.8421H5.98274C5.11074 16.8421 4.40379 17.5491 4.40379 18.4211C4.40379 19.2931 5.11074 20 5.98274 20H14.0173C14.8893 20 15.5962 19.2931 15.5962 18.4211C15.5962 17.5491 14.8893 16.8421 14.0173 16.8421H11.5789V3.15789H16.8421V5.68316C16.8421 6.55516 17.5491 7.2621 18.4211 7.2621C19.2931 7.2621 20 6.55516 20 5.68316V1.57895C20 0.706947 19.2931 0 18.4211 0Z" fill="#D5D5D5"></path>
                                        </svg>
                                        Open Sans1
                                    </div>
                                    <div class="dropdown_option">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.4211 0H1.57895C0.706947 0 0 0.706947 0 1.57895V5.68316C0 6.55516 0.706947 7.2621 1.57895 7.2621C2.45095 7.2621 3.15789 6.55516 3.15789 5.68316V3.15789H8.42105V16.8421H5.98274C5.11074 16.8421 4.40379 17.5491 4.40379 18.4211C4.40379 19.2931 5.11074 20 5.98274 20H14.0173C14.8893 20 15.5962 19.2931 15.5962 18.4211C15.5962 17.5491 14.8893 16.8421 14.0173 16.8421H11.5789V3.15789H16.8421V5.68316C16.8421 6.55516 17.5491 7.2621 18.4211 7.2621C19.2931 7.2621 20 6.55516 20 5.68316V1.57895C20 0.706947 19.2931 0 18.4211 0Z" fill="#D5D5D5"></path>
                                        </svg>
                                        Open Sans2
                                    </div>
                                    <div class="dropdown_option">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.4211 0H1.57895C0.706947 0 0 0.706947 0 1.57895V5.68316C0 6.55516 0.706947 7.2621 1.57895 7.2621C2.45095 7.2621 3.15789 6.55516 3.15789 5.68316V3.15789H8.42105V16.8421H5.98274C5.11074 16.8421 4.40379 17.5491 4.40379 18.4211C4.40379 19.2931 5.11074 20 5.98274 20H14.0173C14.8893 20 15.5962 19.2931 15.5962 18.4211C15.5962 17.5491 14.8893 16.8421 14.0173 16.8421H11.5789V3.15789H16.8421V5.68316C16.8421 6.55516 17.5491 7.2621 18.4211 7.2621C19.2931 7.2621 20 6.55516 20 5.68316V1.57895C20 0.706947 19.2931 0 18.4211 0Z" fill="#D5D5D5"></path>
                                        </svg>
                                        Open Sans3
                                    </div>
                                    <div class="dropdown_option">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.4211 0H1.57895C0.706947 0 0 0.706947 0 1.57895V5.68316C0 6.55516 0.706947 7.2621 1.57895 7.2621C2.45095 7.2621 3.15789 6.55516 3.15789 5.68316V3.15789H8.42105V16.8421H5.98274C5.11074 16.8421 4.40379 17.5491 4.40379 18.4211C4.40379 19.2931 5.11074 20 5.98274 20H14.0173C14.8893 20 15.5962 19.2931 15.5962 18.4211C15.5962 17.5491 14.8893 16.8421 14.0173 16.8421H11.5789V3.15789H16.8421V5.68316C16.8421 6.55516 17.5491 7.2621 18.4211 7.2621C19.2931 7.2621 20 6.55516 20 5.68316V1.57895C20 0.706947 19.2931 0 18.4211 0Z" fill="#D5D5D5"></path>
                                        </svg>
                                        Open Sans4
                                    </div>
                                    <div class="dropdown_option">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.4211 0H1.57895C0.706947 0 0 0.706947 0 1.57895V5.68316C0 6.55516 0.706947 7.2621 1.57895 7.2621C2.45095 7.2621 3.15789 6.55516 3.15789 5.68316V3.15789H8.42105V16.8421H5.98274C5.11074 16.8421 4.40379 17.5491 4.40379 18.4211C4.40379 19.2931 5.11074 20 5.98274 20H14.0173C14.8893 20 15.5962 19.2931 15.5962 18.4211C15.5962 17.5491 14.8893 16.8421 14.0173 16.8421H11.5789V3.15789H16.8421V5.68316C16.8421 6.55516 17.5491 7.2621 18.4211 7.2621C19.2931 7.2621 20 6.55516 20 5.68316V1.57895C20 0.706947 19.2931 0 18.4211 0Z" fill="#D5D5D5"></path>
                                        </svg>
                                        Open Sans5
                                    </div>
                                    <div class="dropdown_option">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.4211 0H1.57895C0.706947 0 0 0.706947 0 1.57895V5.68316C0 6.55516 0.706947 7.2621 1.57895 7.2621C2.45095 7.2621 3.15789 6.55516 3.15789 5.68316V3.15789H8.42105V16.8421H5.98274C5.11074 16.8421 4.40379 17.5491 4.40379 18.4211C4.40379 19.2931 5.11074 20 5.98274 20H14.0173C14.8893 20 15.5962 19.2931 15.5962 18.4211C15.5962 17.5491 14.8893 16.8421 14.0173 16.8421H11.5789V3.15789H16.8421V5.68316C16.8421 6.55516 17.5491 7.2621 18.4211 7.2621C19.2931 7.2621 20 6.55516 20 5.68316V1.57895C20 0.706947 19.2931 0 18.4211 0Z" fill="#D5D5D5"></path>
                                        </svg>
                                        Open Sans6
                                    </div>
                                    <div class="dropdown_option">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.4211 0H1.57895C0.706947 0 0 0.706947 0 1.57895V5.68316C0 6.55516 0.706947 7.2621 1.57895 7.2621C2.45095 7.2621 3.15789 6.55516 3.15789 5.68316V3.15789H8.42105V16.8421H5.98274C5.11074 16.8421 4.40379 17.5491 4.40379 18.4211C4.40379 19.2931 5.11074 20 5.98274 20H14.0173C14.8893 20 15.5962 19.2931 15.5962 18.4211C15.5962 17.5491 14.8893 16.8421 14.0173 16.8421H11.5789V3.15789H16.8421V5.68316C16.8421 6.55516 17.5491 7.2621 18.4211 7.2621C19.2931 7.2621 20 6.55516 20 5.68316V1.57895C20 0.706947 19.2931 0 18.4211 0Z" fill="#D5D5D5"></path>
                                        </svg>
                                        Open Sans7
                                    </div>
                                    <div class="dropdown_option">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.4211 0H1.57895C0.706947 0 0 0.706947 0 1.57895V5.68316C0 6.55516 0.706947 7.2621 1.57895 7.2621C2.45095 7.2621 3.15789 6.55516 3.15789 5.68316V3.15789H8.42105V16.8421H5.98274C5.11074 16.8421 4.40379 17.5491 4.40379 18.4211C4.40379 19.2931 5.11074 20 5.98274 20H14.0173C14.8893 20 15.5962 19.2931 15.5962 18.4211C15.5962 17.5491 14.8893 16.8421 14.0173 16.8421H11.5789V3.15789H16.8421V5.68316C16.8421 6.55516 17.5491 7.2621 18.4211 7.2621C19.2931 7.2621 20 6.55516 20 5.68316V1.57895C20 0.706947 19.2931 0 18.4211 0Z" fill="#D5D5D5"></path>
                                        </svg>
                                        Open Sans8
                                    </div>
                                    <div class="dropdown_option">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.4211 0H1.57895C0.706947 0 0 0.706947 0 1.57895V5.68316C0 6.55516 0.706947 7.2621 1.57895 7.2621C2.45095 7.2621 3.15789 6.55516 3.15789 5.68316V3.15789H8.42105V16.8421H5.98274C5.11074 16.8421 4.40379 17.5491 4.40379 18.4211C4.40379 19.2931 5.11074 20 5.98274 20H14.0173C14.8893 20 15.5962 19.2931 15.5962 18.4211C15.5962 17.5491 14.8893 16.8421 14.0173 16.8421H11.5789V3.15789H16.8421V5.68316C16.8421 6.55516 17.5491 7.2621 18.4211 7.2621C19.2931 7.2621 20 6.55516 20 5.68316V1.57895C20 0.706947 19.2931 0 18.4211 0Z" fill="#D5D5D5"></path>
                                        </svg>
                                        Open Sans9
                                    </div>
                                </div>
                            </div>
                            <div class="font_btn_wrapper">
                                <a href="#" class="font_weight">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.5999 11V12C13.5999 13.1042 13.2353 14.0469 12.5062 14.8281C11.777 15.6094 10.8971 16 9.86657 16H3.33324C3.07074 16 2.84956 15.901 2.66969 15.7031C2.48983 15.5052 2.3999 15.2708 2.3999 15V1C2.3999 0.729167 2.48983 0.494792 2.66969 0.296875C2.84956 0.0989583 3.07074 0 3.33324 0H9.86657C10.8971 0 11.777 0.390625 12.5062 1.17188C13.2353 1.95312 13.5999 2.89583 13.5999 4V4.5C13.5999 5.08333 13.4857 5.63542 13.2572 6.15625C13.0287 6.67708 12.72 7.125 12.3312 7.5C12.7006 7.85417 13.0044 8.36979 13.2426 9.04688C13.4808 9.72396 13.5999 10.375 13.5999 11ZM9.3999 3H5.66657C5.54018 3 5.43081 3.04948 5.33844 3.14844C5.24608 3.2474 5.1999 3.36458 5.1999 3.5V5.5C5.1999 5.63542 5.24608 5.7526 5.33844 5.85156C5.43081 5.95052 5.54018 6 5.66657 6H9.3999C9.77907 6 10.1072 5.85417 10.3843 5.5625C10.6614 5.27083 10.7999 4.91667 10.7999 4.5C10.7999 4.08333 10.6614 3.72917 10.3843 3.4375C10.1072 3.14583 9.77907 3 9.3999 3ZM8.93324 9H5.66657C5.54018 9 5.43081 9.04948 5.33844 9.14844C5.24608 9.2474 5.1999 9.36458 5.1999 9.5V12.5C5.1999 12.6354 5.24608 12.7526 5.33844 12.8516C5.43081 12.9505 5.54018 13 5.66657 13H8.93324C9.44851 13 9.88844 12.8047 10.253 12.4141C10.6176 12.0234 10.7999 11.5521 10.7999 11C10.7999 10.4479 10.6176 9.97656 10.253 9.58594C9.88844 9.19531 9.44851 9 8.93324 9Z" fill="#888888"></path>
                                    </svg>
                                </a>
                                <a href="#" class="font_italics">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0)">
                                            <path d="M5.00002 0C4.44773 0 4.00002 0.447715 4.00002 1C4.00002 1.55228 4.44773 2 5.00002 2H6.97366C7.10738 2 7.19605 2.13859 7.14002 2.26L3.14002 12.26L2.70714 13.3804C2.55822 13.7658 2.18756 14.02 1.77434 14.02H1.02002C0.467735 14.02 0.0200195 14.4677 0.0200195 15.02C0.0200195 15.5723 0.467735 16.02 1.02002 16.02H9.02002C9.5723 16.02 10.02 15.5723 10.02 15.02C10.02 14.4677 9.5723 14.02 9.02002 14.02H7.04638C6.91266 14.02 6.82399 13.8814 6.88002 13.76L10.88 3.76L11.3129 2.6396C11.4618 2.25415 11.8325 2 12.2457 2H13C13.5523 2 14 1.55228 14 1C14 0.447715 13.5523 0 13 0H5.00002Z" fill="#888888"></path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0">
                                                <rect width="16" height="16" fill="white"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div class="name_logo_wrapper">
                            <input type="text" class="name_logo" value="Text">
                        </div>

                    </div>
                </div>

                <div class="control_mini_shape" id="controlObjectColor" style="display: none;">
                    <div class="controlGradient"></div>
                    <div class="bg_dashboard_tool_wrapper text_color_wrapper">
                        <input type="color" class="bg_dashboard_tool selected-text" />
                    </div>

                    <a href="" class="control_shape_btn">
                        Set Gradient
                    </a>
                </div>

                <div class="textBar" style="display: none;">
                    <div class="mini_text_wrapper">
                        <!-- <div class="control_mini_shape">
                            <div class="bg_dashboard_tool_wrapper text_color_wrapper">
                                <input type="color" class="bg_dashboard_tool selected-text" />
                            </div>
                            <a href="#" class="icon_btn copy_text">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.3083 3.40937H12.5739V0.98125C12.5739 0.628125 12.2896 0.34375 11.9364 0.34375H1.2708C0.917676 0.34375 0.633301 0.628125 0.633301 0.98125V11.95C0.633301 12.3031 0.917676 12.5875 1.2708 12.5875H4.00518V15.0156C4.00518 15.3687 4.28955 15.6531 4.64268 15.6531H15.3083C15.6614 15.6531 15.9458 15.3687 15.9458 15.0156V4.04688C15.9458 3.69688 15.6614 3.40937 15.3083 3.40937ZM1.9083 11.3125V1.61875H11.2958V3.40937H4.64268C4.28955 3.40937 4.00518 3.69375 4.00518 4.04688V11.3125H1.9083ZM14.6708 14.3813H5.28018V4.6875H14.6677V14.3813H14.6708Z" fill="#929292"></path>
                                </svg>
                            </a>
                            <a href="#" class="icon_btn paste_text">
                                <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0)">
                                        <path d="M14.5896 7.2V7.3H14.6896C15.5167 7.3 16.1896 7.97283 16.1896 8.8V14.4C16.1896 15.2272 15.5167 15.9 14.6896 15.9H9.08955C8.26238 15.9 7.58955 15.2272 7.58955 14.4V14.3H7.48955H1.88955C1.06238 14.3 0.389551 13.6272 0.389551 12.8V2.4C0.389551 1.57283 1.06238 0.9 1.88955 0.9H4.28955H4.38955V0.8C4.38955 0.614349 4.4633 0.436301 4.59458 0.305025C4.72585 0.17375 4.9039 0.1 5.08955 0.1H9.88955C10.0752 0.1 10.2533 0.17375 10.3845 0.305025C10.5158 0.436301 10.5896 0.614349 10.5896 0.8V0.9H10.6896H13.0896C13.9167 0.9 14.5896 1.57283 14.5896 2.4V7.2ZM7.48955 12.9H7.58955V12.8V8.8C7.58955 7.97283 8.26238 7.3 9.08955 7.3H13.0896H13.1896V7.2V2.4V2.3H13.0896H10.6896H10.5896V2.4V3.9H4.38955V2.4V2.3H4.28955H1.88955H1.78955V2.4V12.8V12.9H1.88955H7.48955ZM8.98955 14.4V14.5H9.08955H14.6904H14.7904L14.7904 14.4L14.7896 8.79999L14.7895 8.7H14.6896H9.08955H8.98955V8.8V14.4Z" fill="#929292" stroke="#353535" stroke-width="0.2"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect width="16" height="16" fill="white" transform="translate(0.289551)"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                            <a href="#" class="control_shape_btn">
                                Set Gradient
                            </a>
                        </div> -->
                    </div>
                    <div class="widget_control_btns">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 padding_right_0">
                                <div class="btn_control_item">
                                    <h5 class="btn_control_title">Text Alignment</h5>
                                    <div class="btn_control_wrapper">
                                        <a href="#" class="btn_control text-align" data-align="left">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15 2.28571H1C0.734784 2.28571 0.48043 2.16531 0.292893 1.95098C0.105357 1.73665 0 1.44596 0 1.14286C0 0.839753 0.105357 0.549063 0.292893 0.334735C0.48043 0.120408 0.734784 0 1 0H15C15.2652 0 15.5196 0.120408 15.7071 0.334735C15.8946 0.549063 16 0.839753 16 1.14286C16 1.44596 15.8946 1.73665 15.7071 1.95098C15.5196 2.16531 15.2652 2.28571 15 2.28571ZM11 6.85714H1C0.734784 6.85714 0.48043 6.73674 0.292893 6.52241C0.105357 6.30808 0 6.01739 0 5.71429C0 5.41118 0.105357 5.12049 0.292893 4.90616C0.48043 4.69184 0.734784 4.57143 1 4.57143H11C11.2652 4.57143 11.5196 4.69184 11.7071 4.90616C11.8946 5.12049 12 5.41118 12 5.71429C12 6.01739 11.8946 6.30808 11.7071 6.52241C11.5196 6.73674 11.2652 6.85714 11 6.85714ZM15 11.4286H1C0.734784 11.4286 0.48043 11.3082 0.292893 11.0938C0.105357 10.8795 0 10.5888 0 10.2857C0 9.98261 0.105357 9.69192 0.292893 9.47759C0.48043 9.26327 0.734784 9.14286 1 9.14286H15C15.2652 9.14286 15.5196 9.26327 15.7071 9.47759C15.8946 9.69192 16 9.98261 16 10.2857C16 10.5888 15.8946 10.8795 15.7071 11.0938C15.5196 11.3082 15.2652 11.4286 15 11.4286ZM11 16H1C0.734784 16 0.48043 15.8796 0.292893 15.6653C0.105357 15.4509 0 15.1602 0 14.8571C0 14.554 0.105357 14.2633 0.292893 14.049C0.48043 13.8347 0.734784 13.7143 1 13.7143H11C11.2652 13.7143 11.5196 13.8347 11.7071 14.049C11.8946 14.2633 12 14.554 12 14.8571C12 15.1602 11.8946 15.4509 11.7071 15.6653C11.5196 15.8796 11.2652 16 11 16Z" fill="#929292"></path>
                                            </svg>
                                        </a>
                                        <a href="#" class="btn_control text-align" data-align="center">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15 2.28571H1C0.734784 2.28571 0.48043 2.16531 0.292893 1.95098C0.105357 1.73665 0 1.44596 0 1.14286C0 0.839753 0.105357 0.549063 0.292893 0.334735C0.48043 0.120408 0.734784 0 1 0H15C15.2652 0 15.5196 0.120408 15.7071 0.334735C15.8946 0.549063 16 0.839753 16 1.14286C16 1.44596 15.8946 1.73665 15.7071 1.95098C15.5196 2.16531 15.2652 2.28571 15 2.28571ZM13 6.85714H3C2.73478 6.85714 2.48043 6.73674 2.29289 6.52241C2.10536 6.30808 2 6.01739 2 5.71429C2 5.41118 2.10536 5.12049 2.29289 4.90616C2.48043 4.69184 2.73478 4.57143 3 4.57143H13C13.2652 4.57143 13.5196 4.69184 13.7071 4.90616C13.8946 5.12049 14 5.41118 14 5.71429C14 6.01739 13.8946 6.30808 13.7071 6.52241C13.5196 6.73674 13.2652 6.85714 13 6.85714ZM15 11.4286H1C0.734784 11.4286 0.48043 11.3082 0.292893 11.0938C0.105357 10.8795 0 10.5888 0 10.2857C0 9.98261 0.105357 9.69192 0.292893 9.47759C0.48043 9.26327 0.734784 9.14286 1 9.14286H15C15.2652 9.14286 15.5196 9.26327 15.7071 9.47759C15.8946 9.69192 16 9.98261 16 10.2857C16 10.5888 15.8946 10.8795 15.7071 11.0938C15.5196 11.3082 15.2652 11.4286 15 11.4286ZM13 16H3C2.73478 16 2.48043 15.8796 2.29289 15.6653C2.10536 15.4509 2 15.1602 2 14.8571C2 14.554 2.10536 14.2633 2.29289 14.049C2.48043 13.8347 2.73478 13.7143 3 13.7143H13C13.2652 13.7143 13.5196 13.8347 13.7071 14.049C13.8946 14.2633 14 14.554 14 14.8571C14 15.1602 13.8946 15.4509 13.7071 15.6653C13.5196 15.8796 13.2652 16 13 16Z" fill="#929292"></path>
                                            </svg>
                                        </a>
                                        <a href="#" class="btn_control text-align" data-align="right">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1 2.28571H15C15.2652 2.28571 15.5196 2.16531 15.7071 1.95098C15.8946 1.73665 16 1.44596 16 1.14286C16 0.839753 15.8946 0.549063 15.7071 0.334735C15.5196 0.120408 15.2652 0 15 0H1C0.734783 0 0.480429 0.120408 0.292892 0.334735C0.105356 0.549063 0 0.839753 0 1.14286C0 1.44596 0.105356 1.73665 0.292892 1.95098C0.480429 2.16531 0.734783 2.28571 1 2.28571ZM5 6.85714H15C15.2652 6.85714 15.5196 6.73674 15.7071 6.52241C15.8946 6.30808 16 6.01739 16 5.71429C16 5.41118 15.8946 5.12049 15.7071 4.90616C15.5196 4.69184 15.2652 4.57143 15 4.57143H5C4.73478 4.57143 4.48043 4.69184 4.29289 4.90616C4.10536 5.12049 4 5.41118 4 5.71429C4 6.01739 4.10536 6.30808 4.29289 6.52241C4.48043 6.73674 4.73478 6.85714 5 6.85714ZM1 11.4286H15C15.2652 11.4286 15.5196 11.3082 15.7071 11.0938C15.8946 10.8795 16 10.5888 16 10.2857C16 9.98261 15.8946 9.69192 15.7071 9.47759C15.5196 9.26327 15.2652 9.14286 15 9.14286H1C0.734783 9.14286 0.480429 9.26327 0.292892 9.47759C0.105356 9.69192 0 9.98261 0 10.2857C0 10.5888 0.105356 10.8795 0.292892 11.0938C0.480429 11.3082 0.734783 11.4286 1 11.4286ZM5 16H15C15.2652 16 15.5196 15.8796 15.7071 15.6653C15.8946 15.4509 16 15.1602 16 14.8571C16 14.554 15.8946 14.2633 15.7071 14.049C15.5196 13.8347 15.2652 13.7143 15 13.7143H5C4.73478 13.7143 4.48043 13.8347 4.29289 14.049C4.10536 14.2633 4 14.554 4 14.8571C4 15.1602 4.10536 15.4509 4.29289 15.6653C4.48043 15.8796 4.73478 16 5 16Z" fill="#929292"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6" style="display: none;">
                                <div class="btn_control_item">
                                    <h5 class="btn_control_title">Curved Text</h5>
                                    <div class="btn_control_wrapper">
                                        <a href="" class="btn_control">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.84239 7H7.15761V1.23529H5V0H11V1.23529H8.84239V7Z" fill="#929292"></path>
                                                <circle cx="2" cy="14" r="2" fill="#929292"></circle>
                                                <circle cx="14" cy="14" r="2" fill="#929292"></circle>
                                                <path d="M2 13C2 13 3.5 9 8 9C12.5 9 14 13 14 13" stroke="#929292"></path>
                                            </svg>
                                        </a>
                                        <a href="" class="btn_control">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.84239 16H7.15761V10.2353H5V9H11V10.2353H8.84239V16Z" fill="#929292"></path>
                                                <circle cx="2" cy="2" r="2" fill="#929292"></circle>
                                                <circle cx="14" cy="2" r="2" fill="#929292"></circle>
                                                <path d="M2 2C2 2 3.5 7 8 7C12.5 7 14 2 14 2" stroke="#929292"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="range_wrapper">
                        <input type="range" value="0" min="0" max="1000" step="1" class="slider_range char_spacing_range">
                        <input type="text" class="name_logo char_spacing_value" style="padding: 10px 8px" value="0">
                    </div>
                </div>

                <div id="globalToolBar">
                    <div class="tools_btn_wrapper">
                        <p class="tools_btn_wrapper_txt">Click on item to edit or click below to add more
                            content</p>
                        <a href="#" class="tools_btn add-new-text">
                            <div class="tools_btn_icon">
                                @php include(public_path('site/img/btn-tools-dashboard-1.svg')) @endphp
                            </div>
                            Add Text
                        </a>
                        <a href="#" class="tools_btn open-modal" data-modal="add_shape">
                            <div class="tools_btn_icon">
                                @php include(public_path('site/img/btn-tools-dashboard-2.svg')) @endphp
                            </div>
                            Add Shape
                        </a>
                        <a href="#" class="tools_btn open-modal" data-modal="add_icon">
                            <div class="tools_btn_icon">
                                @php include(public_path('site/img/btn-tools-dashboard-3.svg')) @endphp
                            </div>
                            Add Icon
                        </a>
                        <a href="#" class="tools_btn open-modal" data-modal="add_logo">
                            <div class="tools_btn_icon">
                                @php include(public_path('site/img/btn-tools-dashboard-4.svg')) @endphp
                            </div>
                            Add Logo
                        </a>
                    </div>
                    <div class="colors" style="display: none;">
                        <h3 class="colors_title">Colors</h3>
                        <div class="colors_wrapper">
                            <!-- <div class="bg_dashboard_tool_wrapper">
                                <div class="bg_dashboard_tool"></div>
                            </div>
                            <div class="bg_dashboard_tool_wrapper">
                                <div class="bg_dashboard_tool green"></div>
                            </div>
                            <div class="bg_dashboard_tool_wrapper">
                                <div class="bg_dashboard_tool yellow"></div>
                            </div>
                            <div class="bg_dashboard_tool_wrapper">
                                <div class="bg_dashboard_tool black"></div>
                            </div>
                            <div class="bg_dashboard_tool_wrapper">
                                <div class="bg_dashboard_tool violet"></div>
                            </div>
                            <div class="bg_dashboard_tool_wrapper">
                                <div class="bg_dashboard_tool blue"></div>
                            </div> -->
                        </div>
                    </div>
                </div>

                <div id="controlPanel" style="display: none;">
                    <div class="widget_control_btns">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="btn_control_item">
                                    <h5 class="btn_control_title">Flip</h5>
                                    <div class="btn_control_wrapper">
                                        <a href="#" class="btn_control flip-object" data-val="h">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0)">
                                                    <path d="M6.04981 0.416019L0.050314 15.0814C-0.129108 15.52 0.193458 16.0005 0.667293 16.0005H6.66679C7.03495 16.0005 7.33339 15.702 7.33339 15.3339V0.668404C7.33339 -0.0626593 6.3266 -0.260643 6.04981 0.416019ZM6.00019 14.6672H1.66024L6.00019 4.05846V14.6672Z" fill="#929292"></path>
                                                    <path d="M15.9496 15.0809L9.95008 0.415508C9.67329 -0.261123 8.6665 -0.0631393 8.6665 0.667893V15.3333C8.6665 15.7015 8.96495 15.9999 9.3331 15.9999H15.3326C15.8064 16 16.129 15.5195 15.9496 15.0809ZM9.99974 14.6667V4.05795L14.3397 14.6667H9.99974Z" fill="#929292"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0">
                                                        <rect width="16" height="16" fill="white"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                        <a href="#" class="btn_control flip-object" data-val="v">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0)">
                                                    <path d="M0.416263 9.95019L15.0817 15.9497C15.5202 16.1291 16.0007 15.8065 16.0007 15.3327L16.0007 9.33321C16.0007 8.96505 15.7023 8.66661 15.3341 8.66661L0.668648 8.66661C-0.0624155 8.66661 -0.260399 9.6734 0.416263 9.95019ZM14.6675 9.99981L14.6675 14.3398L4.05871 9.99981L14.6675 9.99981Z" fill="#929292"></path>
                                                    <path d="M15.0809 0.0504163L0.415508 6.04992C-0.261123 6.32671 -0.0631393 7.3335 0.667893 7.3335L15.3333 7.3335C15.7015 7.3335 15.9999 7.03505 15.9999 6.6669L15.9999 0.667397C16 0.193562 15.5195 -0.129006 15.0809 0.0504163ZM14.6667 6.00026L4.05795 6.00026L14.6667 1.66031L14.6667 6.00026Z" fill="#929292"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0">
                                                        <rect width="16" height="16" fill="white" transform="translate(0 16) rotate(-90)"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="btn_control_item">
                                    <h5 class="btn_control_title">Rotate</h5>
                                    <div class="btn_control_wrapper">
                                        <a href="#" data-to="left" class="btn_control rotate-object">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.4052 1.0682L11.3663 1.1603C12.2503 1.53424 13.0441 2.06931 13.7257 2.75088C14.4073 3.43244 14.9423 4.22618 15.3163 5.11028C15.7036 6.02603 15.9 6.99818 15.9 8.00015C15.9 9.00213 15.7036 9.97424 15.3163 10.89C14.9423 11.7741 14.4073 12.5679 13.7257 13.2494C13.0441 13.931 12.2504 14.4661 11.3663 14.84C10.4505 15.2273 9.47841 15.4237 8.47643 15.4237C7.62076 15.4237 6.78178 15.2792 5.98257 14.9942C5.21016 14.7188 4.49229 14.3188 3.84879 13.8052L3.7864 13.8833L3.84878 13.8052C3.21161 13.2967 2.66552 12.6914 2.2256 12.0063C1.77745 11.3083 1.45214 10.5467 1.25862 9.74242C1.14551 9.27235 1.43489 8.79957 1.90497 8.68647C2.37507 8.57333 2.84781 8.86275 2.96092 9.33281C3.25356 10.5491 3.95677 11.6512 4.94095 12.4367C5.43267 12.8292 5.98099 13.1348 6.57061 13.345C7.1807 13.5626 7.82198 13.6729 8.47641 13.6729C9.99143 13.6729 11.4163 13.0826 12.4876 12.0114C13.5589 10.9401 14.1491 9.51518 14.1491 8.00015C14.1491 6.48511 13.5589 5.06029 12.4876 3.98898C11.4163 2.91767 9.99139 2.32748 8.47637 2.32748C7.35692 2.32748 6.27424 2.65294 5.34571 3.26873L5.40098 3.35207L5.34571 3.26873C4.54587 3.79921 3.89783 4.51702 3.45439 5.35943L3.37723 5.50601H3.54288H4.62102C5.10449 5.50601 5.49646 5.89796 5.49646 6.38146C5.49646 6.86495 5.10449 7.25691 4.62102 7.25691H0.975447C0.49195 7.25691 0.1 6.86496 0.1 6.38146V2.6862C0.1 2.20271 0.49195 1.81075 0.975447 1.81075C1.45894 1.81075 1.85089 2.20271 1.85089 2.6862V4.25303V4.62784L2.0376 4.30285C2.61095 3.30485 3.40928 2.45204 4.37798 1.80957C5.59426 1.00294 7.01132 0.576563 8.47641 0.576563C9.47839 0.576563 10.4505 0.772963 11.3663 1.1603L11.4052 1.0682Z" fill="#929292" stroke="#424242" stroke-width="0.2"></path>
                                            </svg>
                                        </a>
                                        <a href="#" href="#" data-to="right" class="btn_control rotate-object">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4.59478 1.0682L4.63374 1.1603C3.74965 1.53424 2.95591 2.06931 2.27433 2.75088C1.59275 3.43244 1.05768 4.22618 0.683723 5.11028C0.296402 6.02603 0.100002 6.99818 0.100002 8.00015C0.100002 9.00213 0.296402 9.97424 0.683722 10.89C1.0577 11.7741 1.59275 12.5679 2.27433 13.2494C2.95591 13.931 3.74962 14.4661 4.63372 14.84C5.54946 15.2273 6.52159 15.4237 7.52357 15.4237C8.37924 15.4237 9.21822 15.2792 10.0174 14.9942C10.7898 14.7188 11.5077 14.3188 12.1512 13.8052L12.2136 13.8833L12.1512 13.8052C12.7884 13.2967 13.3345 12.6914 13.7744 12.0063C14.2225 11.3083 14.5479 10.5467 14.7414 9.74242C14.8545 9.27235 14.5651 8.79957 14.095 8.68647C13.6249 8.57333 13.1522 8.86275 13.0391 9.33281C12.7464 10.5491 12.0432 11.6512 11.059 12.4367C10.5673 12.8292 10.019 13.1348 9.42939 13.345C8.8193 13.5626 8.17802 13.6729 7.52359 13.6729C6.00857 13.6729 4.58374 13.0826 3.51241 12.0114C2.44109 10.9401 1.85091 9.51518 1.85091 8.00015C1.85091 6.48511 2.44114 5.06029 3.51241 3.98898C4.58372 2.91767 6.00861 2.32748 7.52363 2.32748C8.64308 2.32748 9.72576 2.65294 10.6543 3.26873L10.599 3.35207L10.6543 3.26873C11.4541 3.79921 12.1022 4.51702 12.5456 5.35943L12.6228 5.50601H12.4571H11.379C10.8955 5.50601 10.5035 5.89796 10.5035 6.38146C10.5035 6.86495 10.8955 7.25691 11.379 7.25691H15.0246C15.5081 7.25691 15.9 6.86496 15.9 6.38146V2.6862C15.9 2.20271 15.5081 1.81075 15.0246 1.81075C14.5411 1.81075 14.1491 2.20271 14.1491 2.6862V4.25303V4.62784L13.9624 4.30285C13.3891 3.30485 12.5907 2.45204 11.622 1.80957C10.4057 1.00294 8.98868 0.576563 7.52359 0.576563C6.52161 0.576563 5.54948 0.772963 4.63374 1.1603L4.59478 1.0682Z" fill="#929292" stroke="#424242" stroke-width="0.2"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="btn_control_item">
                                    <h5 class="btn_control_title">Move</h5>
                                    <div class="btn_control_wrapper">
                                        <a href="#" class="btn_control object-move" data-to="top">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0)">
                                                    <path d="M1.66243 7.80009C1.39694 8.12684 1.62947 8.61538 2.05049 8.61538L6.33333 8.61538C6.60948 8.61538 6.83333 8.83924 6.83333 9.11538L6.83333 15.5C6.83333 15.7761 7.05719 16 7.33333 16L8.66667 16C8.94281 16 9.16667 15.7761 9.16667 15.5L9.16667 9.11538C9.16667 8.83924 9.39053 8.61538 9.66667 8.61538L13.9495 8.61538C14.3705 8.61538 14.6031 8.12685 14.3376 7.80009L8.38806 0.477607C8.18796 0.231336 7.81204 0.231336 7.61194 0.477607L1.66243 7.80009Z" fill="#929292"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0">
                                                        <rect x="16" y="16" width="16" height="16" transform="rotate(-180 16 16)" fill="white"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                        <a href="#" class="btn_control object-move" data-to="bottom">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.3376 8.19991C14.6031 7.87315 14.3705 7.38462 13.9495 7.38462L9.66667 7.38462C9.39052 7.38462 9.16667 7.16076 9.16667 6.88462V0.5C9.16667 0.223858 8.94281 0 8.66667 0L7.33333 0C7.05719 0 6.83333 0.223858 6.83333 0.5L6.83333 6.88462C6.83333 7.16076 6.60948 7.38462 6.33333 7.38462L2.05049 7.38462C1.62947 7.38462 1.39694 7.87315 1.66243 8.19991L7.61194 15.5224C7.81204 15.7687 8.18796 15.7687 8.38806 15.5224L14.3376 8.19991Z" fill="#929292"></path>
                                            </svg>
                                        </a>
                                        <a href="#" class="btn_control object-move" data-to="left">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0)">
                                                    <path d="M7.80009 14.3376C8.12685 14.6031 8.61538 14.3705 8.61538 13.9495L8.61538 9.66667C8.61538 9.39052 8.83924 9.16667 9.11538 9.16667L15.5 9.16667C15.7761 9.16667 16 8.94281 16 8.66667L16 7.33333C16 7.05719 15.7761 6.83333 15.5 6.83333L9.11538 6.83333C8.83924 6.83333 8.61538 6.60948 8.61538 6.33333L8.61538 2.05049C8.61538 1.62947 8.12685 1.39694 7.80009 1.66243L0.477607 7.61194C0.231336 7.81204 0.231336 8.18796 0.477607 8.38806L7.80009 14.3376Z" fill="#929292"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0">
                                                        <rect width="16" height="16" fill="white" transform="translate(16) rotate(90)"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                        <a href="#" class="btn_control object-move" data-to="right">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0)">
                                                    <path d="M8.19991 1.66243C7.87315 1.39694 7.38462 1.62947 7.38462 2.05049L7.38462 6.33333C7.38462 6.60948 7.16076 6.83333 6.88462 6.83333L0.5 6.83333C0.223858 6.83333 9.4717e-08 7.05719 9.14241e-08 7.33333L7.55242e-08 8.66667C7.22313e-08 8.94281 0.223858 9.16667 0.5 9.16667L6.88462 9.16667C7.16076 9.16667 7.38462 9.39052 7.38462 9.66667L7.38462 13.9495C7.38462 14.3705 7.87315 14.6031 8.19991 14.3376L15.5224 8.38806C15.7687 8.18796 15.7687 7.81204 15.5224 7.61194L8.19991 1.66243Z" fill="#929292"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0">
                                                        <rect width="16" height="16" fill="white" transform="translate(0 16) rotate(-90)"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="btn_control_item">
                                    <h5 class="btn_control_title">Layer Order</h5>
                                    <div class="btn_control_wrapper">
                                        <a href="#" class="btn_control layer-order" data-to="down">
                                            <svg width="17" height="19" viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.29722 6.40332L2.12024 7.83255C1.44494 8.14024 1.44494 8.64409 2.12024 8.95178L7.7989 11.5475C8.44696 11.8437 9.51363 11.8437 10.1617 11.5475L15.8403 8.95178C16.5195 8.64409 16.5195 8.14024 15.8442 7.83255L12.6641 6.40332" fill="#929292"></path>
                                                <path d="M5.29722 6.40332L2.12024 7.83255C1.44494 8.14024 1.44494 8.64409 2.12024 8.95178L7.7989 11.5475C8.44696 11.8437 9.51363 11.8437 10.1617 11.5475L15.8403 8.95178C16.5195 8.64409 16.5195 8.14024 15.8442 7.83255L12.6641 6.40332" stroke="#929292" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M15.8412 3.83269L10.1103 1.21346C9.48914 0.928846 8.47235 0.928846 7.85115 1.21346L2.12415 3.83269C1.44885 4.14038 1.44885 4.64385 2.12415 4.95154L7.80281 7.54769C8.45087 7.84385 9.51753 7.84385 10.1656 7.54769L15.8442 4.95154C16.5165 4.64385 16.5165 4.14 15.8412 3.83269Z" fill="#424242" stroke="#929292" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M12.6228 14.9068C13.2467 14.2349 12.7702 13.1423 11.8534 13.1423H10.2167V10.5C10.2167 9.9201 9.74657 9.45 9.16667 9.45H8.83333C8.25344 9.45 7.78333 9.9201 7.78333 10.5V13.1423H6.14661C5.22978 13.1423 4.75332 14.2349 5.37717 14.9068L8.23057 17.9797C8.64598 18.427 9.35402 18.427 9.76943 17.9797L9.3664 17.6054L9.76943 17.9797L12.6228 14.9068Z" fill="#929292" stroke="#424242" stroke-width="1.1"></path>
                                            </svg>
                                        </a>
                                        <a href="#" class="btn_control layer-order" data-to="up">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0)">
                                                    <path d="M14.8412 6.83269L9.11034 4.21346C8.48914 3.92885 7.47235 3.92885 6.85115 4.21346L1.12415 6.83269C0.448851 7.14038 0.448851 7.64385 1.12415 7.95154L6.80281 10.5477C7.45087 10.8438 8.51753 10.8438 9.16559 10.5477L14.8442 7.95154C15.5165 7.64385 15.5165 7.14 14.8412 6.83269Z" fill="#929292" stroke="#929292" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M4.29722 9.40332L1.12024 10.8325C0.444945 11.1402 0.444945 11.6441 1.12024 11.9518L6.7989 14.5475C7.44696 14.8437 8.51363 14.8437 9.16168 14.5475L14.8403 11.9518C15.5195 11.6441 15.5195 11.1402 14.8442 10.8325L11.6641 9.40332" stroke="#929292" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <g clip-path="url(#clip1)">
                                                        <path d="M4.37717 3.09322C3.75332 3.76506 4.22978 4.85769 5.14661 4.85769L6.78333 4.85769L6.78333 7.5C6.78333 8.0799 7.25343 8.55 7.83333 8.55L8.16667 8.55C8.74656 8.55 9.21667 8.0799 9.21667 7.5L9.21667 4.85769L10.8534 4.85769C11.7702 4.85769 12.2467 3.76506 11.6228 3.09322L8.76943 0.0203335C8.35402 -0.427036 7.64598 -0.427035 7.23057 0.0203319L7.6336 0.394581L7.23057 0.0203329L4.37717 3.09322Z" fill="#929292" stroke="#424242" stroke-width="1.1"></path>
                                                    </g>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0">
                                                        <rect width="16" height="16" fill="white"></rect>
                                                    </clipPath>
                                                    <clipPath id="clip1">
                                                        <rect width="16" height="16" fill="white" transform="translate(16 16) rotate(-180)"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                        <a href="#" class="btn_control layer-order" data-to="up-all">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0)">
                                                    <path d="M14.8412 3.44793L9.11034 0.828696C8.48914 0.544081 7.47235 0.544081 6.85115 0.828696L1.12415 3.44793C0.448851 3.75562 0.448851 4.25908 1.12415 4.56677L6.80281 7.16293C7.45087 7.45908 8.51753 7.45908 9.16559 7.16293L14.8442 4.56677C15.5165 4.25908 15.5165 3.75523 14.8412 3.44793Z" fill="#929292" stroke="#929292" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M4.29729 10.0196L1.12415 11.4469C0.448851 11.7546 0.448851 12.2584 1.12415 12.5661L6.80281 15.1623C7.45086 15.4581 8.51753 15.4581 9.16559 15.1623L14.8442 12.5661C15.5195 12.2584 15.5195 11.7546 14.8442 11.4469L11.777 9.96729" stroke="#929292" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M4.29722 6.01855L1.12024 7.44778C0.444945 7.75548 0.444945 8.25932 1.12024 8.56701L6.7989 11.1628C7.44696 11.4589 8.51363 11.4589 9.16168 11.1628L14.8403 8.56701C15.5195 8.25932 15.5195 7.75548 14.8442 7.44778L11.6641 6.01855" stroke="#929292" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0">
                                                        <rect width="16" height="16" fill="white"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                        <a href="#" class="btn_control layer-order" data-to="down-all">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0)">
                                                    <path d="M4.29729 10.0196L1.12415 11.4469C0.448851 11.7546 0.448851 12.2584 1.12415 12.5661L6.80281 15.1623C7.45086 15.4581 8.51753 15.4581 9.16559 15.1623L14.8442 12.5661C15.5195 12.2584 15.5195 11.7546 14.8442 11.4469L11.777 9.96729" fill="#929292"></path>
                                                    <path d="M4.29729 10.0196L1.12415 11.4469C0.448851 11.7546 0.448851 12.2584 1.12415 12.5661L6.80281 15.1623C7.45086 15.4581 8.51753 15.4581 9.16559 15.1623L14.8442 12.5661C15.5195 12.2584 15.5195 11.7546 14.8442 11.4469L11.777 9.96729" stroke="#929292" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M4.29722 6.01855L1.12024 7.44778C0.444945 7.75548 0.444945 8.25932 1.12024 8.56701L6.7989 11.1628C7.44696 11.4589 8.51363 11.4589 9.16168 11.1628L14.8403 8.56701C15.5195 8.25932 15.5195 7.75548 14.8442 7.44778L11.6641 6.01855" fill="#424242"></path>
                                                    <path d="M4.29722 6.01855L1.12024 7.44778C0.444945 7.75548 0.444945 8.25932 1.12024 8.56701L6.7989 11.1628C7.44696 11.4589 8.51363 11.4589 9.16168 11.1628L14.8403 8.56701C15.5195 8.25932 15.5195 7.75548 14.8442 7.44778L11.6641 6.01855" stroke="#929292" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M14.8412 3.44793L9.11034 0.828696C8.48914 0.544081 7.47235 0.544081 6.85115 0.828696L1.12415 3.44793C0.448851 3.75562 0.448851 4.25908 1.12415 4.56677L6.80281 7.16293C7.45087 7.45908 8.51753 7.45908 9.16559 7.16293L14.8442 4.56677C15.5165 4.25908 15.5165 3.75523 14.8412 3.44793Z" fill="#424242" stroke="#929292" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0">
                                                        <rect width="16" height="16" fill="white"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="btn_control_item">
                                    <h5 class="btn_control_title">Scale</h5>
                                    <div class="btn_control_wrapper">
                                        <a href="#" class="btn_control scale-object" data-to="up">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect y="6.6665" width="16" height="2.66667" rx="1.33333" fill="#888888"></rect>
                                                <rect x="9.33325" width="16" height="2.66667" rx="1.33333" transform="rotate(90 9.33325 0)" fill="#888888"></rect>
                                            </svg>
                                        </a>
                                        <a href="#" class="btn_control scale-object" data-to="down">
                                            <svg width="16" height="4" viewBox="0 0 16 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect y="0.666504" width="16" height="2.66667" rx="1.33333" fill="#888888"></rect>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="btn_control_item">
                                    <h5 class="btn_control_title">Other</h5>
                                    <div class="btn_control_wrapper">
                                        <a href="#" class="btn_control clone-object">
                                            <svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.1951 4.44748L9.81937 1.07175C9.70774 0.960114 9.55752 0.9 9.4043 0.9H4.51868C4.19477 0.9 3.93186 1.16291 3.93186 1.48682V4.18198H1.23682C0.912927 4.18198 0.65 4.44476 0.65 4.7688V16.5132C0.65 16.8371 0.912911 17.1 1.23682 17.1H9.49805C9.82206 17.1 10.085 16.8371 10.085 16.5132V13.818H12.78C13.1039 13.818 13.3668 13.5552 13.3668 13.2312V4.86255C13.3668 4.71348 13.3096 4.56194 13.1951 4.44748ZM12.1932 12.6444H10.085V8.14453C10.085 7.99264 10.0259 7.84211 9.91312 7.72934L6.53755 4.35377C6.42694 4.24301 6.27702 4.18186 6.12244 4.18186H5.10562V2.07363H8.81748V4.86255C8.81748 5.18645 9.08039 5.44937 9.4043 5.44937H12.1932V12.6444ZM8.91123 15.9264H1.82363V5.35562H5.5355V8.14453C5.5355 8.46845 5.79843 8.73135 6.12244 8.73135H8.91123V15.9264ZM6.70925 7.55759V6.18539L8.08145 7.55759H6.70925ZM11.3633 4.27573H9.99111V2.90353L11.3633 4.27573Z" fill="#929292" stroke="#929292" stroke-width="0.2"></path>
                                            </svg>
                                        </a>
                                        <a href="#" class="btn_control group-objects">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0)">
                                                    <path d="M4.29729 10.0196L1.12415 11.4469C0.448851 11.7546 0.448851 12.2584 1.12415 12.5661L6.80281 15.1623C7.45086 15.4581 8.51753 15.4581 9.16559 15.1623L14.8442 12.5661C15.5195 12.2584 15.5195 11.7546 14.8442 11.4469L11.777 9.96729" stroke="#929292" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M4.29722 6.01855L1.12024 7.44778C0.444945 7.75548 0.444945 8.25932 1.12024 8.56701L6.7989 11.1628C7.44696 11.4589 8.51363 11.4589 9.16168 11.1628L14.8403 8.56701C15.5195 8.25932 15.5195 7.75548 14.8442 7.44778L11.6641 6.01855" fill="#424242"></path>
                                                    <path d="M4.29722 6.01855L1.12024 7.44778C0.444945 7.75548 0.444945 8.25932 1.12024 8.56701L6.7989 11.1628C7.44696 11.4589 8.51363 11.4589 9.16168 11.1628L14.8403 8.56701C15.5195 8.25932 15.5195 7.75548 14.8442 7.44778L11.6641 6.01855" stroke="#929292" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M14.8412 3.44793L9.11034 0.828696C8.48914 0.544081 7.47235 0.544081 6.85115 0.828696L1.12415 3.44793C0.448851 3.75562 0.448851 4.25908 1.12415 4.56677L6.80281 7.16293C7.45087 7.45908 8.51753 7.45908 9.16559 7.16293L14.8442 4.56677C15.5165 4.25908 15.5165 3.75523 14.8412 3.44793Z" fill="#424242" stroke="#929292" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0">
                                                        <rect width="16" height="16" fill="white"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="btn_control_item">
                                    <h5 class="btn_control_title">Delete</h5>
                                    <div class="btn_control_wrapper">
                                        <a href="#" class="btn_control delete-object">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0)">
                                                    <path d="M8.00005 0.000976562C3.5888 0.000976562 0 3.58973 0 8.00092C0 12.4121 3.5888 16.0009 8.00005 16.0009C12.4112 16.0009 16 12.4121 16 8.00092C16 3.58973 12.4112 0.000976562 8.00005 0.000976562ZM8.00005 14.6894C4.31195 14.6894 1.31147 11.689 1.31147 8.00092C1.31147 4.31287 4.31195 1.31244 8.00005 1.31244C11.6881 1.31244 14.6885 4.31287 14.6885 8.00092C14.6885 11.689 11.6881 14.6894 8.00005 14.6894Z" fill="#929292"></path>
                                                    <path d="M8.92733 8.00011L11.1899 5.73762C11.446 5.48152 11.446 5.06636 11.1899 4.81025C10.9338 4.55415 10.5186 4.5542 10.2625 4.81025L7.99997 7.0728L5.73737 4.8102C5.48127 4.55415 5.06611 4.55415 4.81001 4.8102C4.55396 5.06631 4.55396 5.48146 4.81001 5.73757L7.07255 8.00011L4.80996 10.2627C4.55391 10.5188 4.55391 10.934 4.80996 11.1901C4.93801 11.3181 5.10582 11.3821 5.27364 11.3821C5.44146 11.3821 5.60927 11.3181 5.73732 11.1901L7.99992 8.92747L10.2625 11.1901C10.3906 11.3181 10.5584 11.3821 10.7262 11.3821C10.894 11.3821 11.0618 11.3181 11.1899 11.1901C11.446 10.934 11.446 10.5188 11.1899 10.2627L8.92733 8.00011Z" fill="#929292"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0">
                                                        <rect width="16" height="16" fill="white"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="admin_template_editor">
                	<h3 class="dashboard_widget_title">Templates</h3>
                	<p class="tools_btn_wrapper_txt"></p>
					<a href="#" class="tools_btn template_buttons_edit open-modal disabled" data-modal="open_templates" data-action="tshirt">
                        T-shirt
                        <span class="status">
                            <div class="lds-dual-ring"></div>
                        </span>
					</a>

					<a href="#" class="tools_btn template_buttons_edit open-modal disabled" data-modal="open_templates" data-action="card">
						Card
						<span class="status">
                            <div class="lds-dual-ring"></div>
                        </span>
					</a>
                    
					<a href="#" class="tools_btn template_buttons_edit open-modal disabled" data-modal="open_templates" data-action="envelope">
                        Envelope
						<span class="status">
                            <div class="lds-dual-ring"></div>
                        </span>
					</a>
                </div>
                
                @if($admin_mode)
                <div class="admin_template_editor">
                	<h3 class="dashboard_widget_title">Create template</h3>
                	<p class="tools_btn_wrapper_txt">
                	</p>
					<a href="#" class="tools_btn template_buttons" data-action="choose-bg">
						1. Upload background
						<span class="status"></span>
					</a>
					<a href="#" class="tools_btn template_buttons" data-action="apply-bg">
						2. Apply background
						<span class="status"></span>
					</a>
					<a href="#" class="tools_btn template_buttons hidden" data-action="set-editable-area">
						4. Set editable area
						<span class="status"></span>
					</a>
					<a href="#" class="tools_btn template_buttons hidden" data-action="apply-editable-area">
						4. Apply editable area
						<span class="status"></span>
					</a>

					<a href="#" class="tools_btn template_buttons hidden" data-action="save">
						4. Save
						<span class="status"></span>
					</a>

                	template editor here
                </div>
                @endif
            </div>
        </div>
        <div class="dashboard_content">
            <div class="control_wrapper">
                <div class="control">
                    <a href="" class="control_btn reset_project">Reset</a>
                    <a href="" class="control_btn undo deactive">
                        @php include(public_path('site/img/icon-control-btn-1.svg')) @endphp
                        Undo
                    </a>
                    <a href="" class="control_btn redo deactive">
                        Redo
                        @php include(public_path('site/img/icon-control-btn-2.svg')) @endphp
                    </a>
                    <a href="#" class="control_btn open_preview_modal">
                        @php include(public_path('site/img/icon-control-btn-3.svg')) @endphp
                        Preview
                    </a>
                </div>
            </div>

            <canvas id="canvas"></canvas>

            <div class="dashboard_content_footer">
                <div class="wrapper_item border">
                    <label>
                        <span>X:</span>
                        <input type="text" id="footerPositionX" placeholder="Left" value="213">
                    </label>
                    <label>
                        <span>Y:</span>
                        <input type="text" id="footerPositionY" placeholder="Top" value="213">
                    </label>
                </div>
                <div class="wrapper_item border">
                    <div class="label">
                        <span>Layers:</span>
                        <div class="dropdown_wrapper" id="dropdownDashboardFooter">
                            <div class="dropdown_select">1</div>
                            <div class="dropdown_option_wrapper">
                                <div class="dropdown_option">6</div>
                                <div class="dropdown_option">5</div>
                                <div class="dropdown_option">4</div>
                                <div class="dropdown_option">3</div>
                                <div class="dropdown_option">2</div>
                                <div class="dropdown_option">1</div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="wrapper_item">
                    <label>
                        <span>W:</span>
                        <input type="text" id="footerPositionW" placeholder="Width" value="213">
                    </label>
                    <label>
                        <span>H:</span>
                        <input type="text" id="footerPositionH" value="213" placeholder="Height">
                    </label>
                    <label>
                        <span><img src="{{ asset('site/img/icon-degree.svg') }}" alt=""></span>
                        <input type="text" id="footerPositionAngle" value="0°" placeholder="Angle">
                    </label>
                </div>
            </div>
        </div>
    </section>
</main>

<canvas id="downloadCanvas" style="display: none;"></canvas>
@endsection
