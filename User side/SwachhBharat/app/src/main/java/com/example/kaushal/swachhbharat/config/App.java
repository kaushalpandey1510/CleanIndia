package com.example.kaushal.swachhbharat.config;

/**
 * Created by kaushal on 20-03-2019.
 */

public class App {
    //static String url = "http://192.168.43.204/mynation/api/";
    public static String url = "http://192.168.43.144/mynation/";
    public static String login = url + "api/user/login";
    public static String register = url + "api/user/register";
    public static String myComplaint = url + "api/complaint/my";
    public static String newComplaint = url + "api/complaint/post";
    public static String listPublicPlace = url + "api/public_place/get_all";
    public static String listUpcomingEvents = url + "api/event/get_upcoming";
    public static String listFinishedEvents = url + "api/event/get_finished";
    public static String listState = url + "api/state";
    public static String listCity = url + "api/city";
    public static String eventDetail = url+"api/event/detail";
    public static String eventGallery = url+"api/event/gallery";
    public static String getProfile = url+"api/user/get";
    public static String updateProfile = url+"api/user/update";
    //static String ImageUploadPathOnSever ="http://192.168.43.144/android_image/capture_img_upload_to_server.php";
}
