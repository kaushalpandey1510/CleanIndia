package com.example.kaushal.swachhbharat;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.FrameLayout;
import android.widget.ListView;
import android.widget.Toast;

import com.example.kaushal.swachhbharat.adapter.FinishedEventAdapter;
import com.example.kaushal.swachhbharat.adapter.UpcomingEventAdapter;
import com.example.kaushal.swachhbharat.config.App;
import com.example.kaushal.swachhbharat.model.Event;
import com.example.kaushal.swachhbharat.parser.JSONParser;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;

public class FinishedEventActivity extends MainActivity{

    private ProgressDialog progressDialog;
    private ListView lvFinishedEvent;
    private ArrayList<Event> listFinishedEvent = new ArrayList<Event>();


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        FrameLayout contentFrameLayout = (FrameLayout) findViewById(R.id.content_frame); //Remember this is the FrameLayout area within your activity_main.xml
        getLayoutInflater().inflate(R.layout.activity_finished_event, contentFrameLayout);

        lvFinishedEvent = findViewById(R.id.lvFinishedEvent);
        FinishedEventActivity.LoadFinishedEvent loadFinishedEvent = new FinishedEventActivity.LoadFinishedEvent();
        loadFinishedEvent.execute();
    }

    class LoadFinishedEvent extends AsyncTask<String, String, String> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            progressDialog = new ProgressDialog(FinishedEventActivity.this);
            progressDialog.setTitle("Please wait");
            progressDialog.show();
        }

        @Override
        protected String doInBackground(String... strings) {

            String data = "";
            JSONParser jsonParser = new JSONParser();
            String result = jsonParser.parse(App.listFinishedEvents, data);

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
                    Toast.makeText(FinishedEventActivity.this, message, Toast.LENGTH_SHORT).show();

                    JSONArray jsonUpcomingEventList = jsonObject.getJSONArray("event");
                    for (int i=0;i<jsonUpcomingEventList.length();i++)
                    {

                        Event event = new Event();

                        JSONObject jsonFinishedEvent = jsonUpcomingEventList.getJSONObject(i);
                        int event_id = jsonFinishedEvent.getInt("event_id");
                        String title = jsonFinishedEvent.getString("title");
                        //String purpose = jsonFinishedEvent.getString("purpose");
                        //String address = jsonFinishedEvent.getString("address");
                        //String city_name = jsonFinishedEvent.getString("city_name");
                        //String state_name = jsonFinishedEvent.getString("state_name");
                        //String contact_person = jsonFinishedEvent.getString("contact_person");
                        //String email = jsonFinishedEvent.getString("email");
                        //String mobile = jsonFinishedEvent.getString("mobile");
                        String event_date = jsonFinishedEvent.getString("event_date");
                        String event_time = jsonFinishedEvent.getString("event_time");
                        String image = jsonFinishedEvent.getString("image");
                        //String event_type_name = jsonFinishedEvent.getString("event_type_name");

                        event.setEvent_id(event_id);
                        event.setTitle(title);
                        //event.setPurpose(purpose);
                        //event.setAddress(address);
                        //event.setCity_name(city_name);
                        //event.setState_name(state_name);
                        //event.setContact_person(contact_person);
                        //event.setEmail(email);
                        //event.setMobile(mobile);
                        event.setEvent_date(event_date);
                        event.setEvent_time(event_time);
                        event.setImage(image);
                        //event.setEvent_type_name(event_type_name);

                        listFinishedEvent.add(event);

                    }

                    FinishedEventAdapter finishedEventAdapter = new FinishedEventAdapter(FinishedEventActivity.this, listFinishedEvent);
                    lvFinishedEvent.setAdapter(finishedEventAdapter);

                } else {
                    Toast.makeText(FinishedEventActivity.this, message, Toast.LENGTH_SHORT).show();
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }
}
