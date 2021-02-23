package com.example.kaushal.swachhbharat.parser;

import android.util.Log;

import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.net.HttpURLConnection;
import java.net.URL;

/**
 * Created by kaushal on 25-03-2019.
 */

public class JSONParser {

    public String parse(String URL, String data)
    {
        try{
            URL url = new URL(URL);
            HttpURLConnection con = (HttpURLConnection) url.openConnection();
            con.setRequestMethod("POST");
            con.setDoOutput(true);

            //  send request
            DataOutputStream outputStream = new DataOutputStream(con.getOutputStream());
            outputStream.writeBytes(data);
            outputStream.flush();
            outputStream.close();

            //  process the response
            DataInputStream inputStream = new DataInputStream(con.getInputStream());
            String output = inputStream.readLine();
            Log.d("result: ", output);
            return output;
            //Log.d("result", );

        }catch(Exception ex)
        {
            ex.printStackTrace();
            return null;
        }
    }

}
