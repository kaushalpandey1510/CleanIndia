package com.example.kaushal.swachhbharat.utility;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;

public class DateUtility{
    public static String formatDate(String dt) {
        try{
            SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd");
            Date date = sdf.parse(dt);
            sdf = new SimpleDateFormat("dd/MM/yyyy");
            return sdf.format(date);
        }catch (Exception e)
        {
            return null;
        }

    }

    public static String formatTime(String t){

        try{
            SimpleDateFormat sdf = new SimpleDateFormat("H:mm:ss");
            Date time = sdf.parse(t);
            sdf = new SimpleDateFormat("hh:mm:ss aa");
            return sdf.format(time);
        }catch (Exception e)
        {
            return null;
        }

    }
}
