package com.example.kaushal.swachhbharat;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.FrameLayout;
import android.widget.ListView;
import android.widget.Toast;

import com.example.kaushal.swachhbharat.adapter.EventGalleryAdapter;
import com.example.kaushal.swachhbharat.adapter.FinishedEventAdapter;
import com.example.kaushal.swachhbharat.config.App;
import com.example.kaushal.swachhbharat.model.Event;
import com.example.kaushal.swachhbharat.model.EventGallery;
import com.example.kaushal.swachhbharat.parser.JSONParser;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;

public class EventGalleryActivity extends MainActivity {

    private ProgressDialog progressDialog;
    private ListView lvEventGallery;
    private ArrayList<EventGallery> listEventGallery = new ArrayList<EventGallery>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        FrameLayout contentFrameLayout = (FrameLayout) findViewById(R.id.content_frame); //Remember this is the FrameLayout area within your activity_main.xml
        getLayoutInflater().inflate(R.layout.activity_event_gallery, contentFrameLayout);

        lvEventGallery = findViewById(R.id.lvEventGallery);
        int event_id = getIntent().getExtras().getInt("event_id");
        LoadEventGallery loadEventGallery = new LoadEventGallery();
        loadEventGallery.execute(event_id + "");
    }

    class LoadEventGallery extends AsyncTask<String, String, String> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            progressDialog = new ProgressDialog(EventGalleryActivity.this);
            progressDialog.setTitle("Please wait");
            progressDialog.show();
        }

        @Override
        protected String doInBackground(String... strings) {

            String event_id = strings[0];
            String data = "event_id=" + event_id;
            JSONParser jsonParser = new JSONParser();
            String result = jsonParser.parse(App.eventGallery, data);

            return result;
        }

        @Override
        protected void onPostExecute(String output) {
            super.onPostExecute(output);
            progressDialog.cancel();
            try {
                JSONObject jsonObject = new JSONObject(output);
                int success = jsonObject.getInt("success");
                String message = jsonObject.getString("msg");
                if (success == 1) {
                    Toast.makeText(EventGalleryActivity.this, message, Toast.LENGTH_SHORT).show();

                    JSONArray jsonEventGalleryList = jsonObject.getJSONArray("event_gallery");
                    for (int i = 0; i < jsonEventGalleryList.length(); i++) {

                        EventGallery eventGallery = new EventGallery();

                        JSONObject jsonEventGallery = jsonEventGalleryList.getJSONObject(i);
                       // int event_gallery_id = jsonEventGallery.getInt("event_gallery_id");
                        String image = jsonEventGallery.getString("image");
                        int event_id = jsonEventGallery.getInt("event_id");


                        //eventGallery.setEvent_gallery_id(event_gallery_id);
                        eventGallery.setImage(image);
                        eventGallery.setEvent_id(event_id);
                        listEventGallery.add(eventGallery);

                    }

                    EventGalleryAdapter eventGalleryAdapter = new EventGalleryAdapter(EventGalleryActivity.this, listEventGallery);
                    lvEventGallery.setAdapter(eventGalleryAdapter);


                } else {
                    Toast.makeText(EventGalleryActivity.this, message, Toast.LENGTH_SHORT).show();
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }
}
