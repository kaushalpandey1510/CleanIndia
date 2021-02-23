package com.example.kaushal.swachhbharat;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.FrameLayout;
import android.widget.ListView;
import android.widget.ProgressBar;
import android.widget.Toast;

import com.example.kaushal.swachhbharat.adapter.PublicPlaceAdapter;
import com.example.kaushal.swachhbharat.adapter.UpcomingEventAdapter;
import com.example.kaushal.swachhbharat.config.App;
import com.example.kaushal.swachhbharat.model.Event;
import com.example.kaushal.swachhbharat.model.PublicPlace;
import com.example.kaushal.swachhbharat.parser.JSONParser;
import com.example.kaushal.swachhbharat.preference.UserPreference;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;

public class UpcomingEventActivity extends MainActivity{

    private ProgressDialog progressDialog;
    private ListView lvUpcomingEvent;
    private ArrayList<Event> listUpcomingEvent = new ArrayList<Event>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        FrameLayout contentFrameLayout = (FrameLayout) findViewById(R.id.content_frame); //Remember this is the FrameLayout area within your activity_main.xml
        getLayoutInflater().inflate(R.layout.activity_upcoming_event, contentFrameLayout);

        lvUpcomingEvent = findViewById(R.id.lvUpcomingEvent);
        LoadUpcomingEvent loadUpcomingEvent = new LoadUpcomingEvent();
        loadUpcomingEvent.execute();
    }

    class LoadUpcomingEvent extends AsyncTask<String, String, String> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            progressDialog = new ProgressDialog(UpcomingEventActivity.this);
            progressDialog.setTitle("Please wait");
            progressDialog.show();
        }

        @Override
        protected String doInBackground(String... strings) {

            String data = "";
            JSONParser jsonParser = new JSONParser();
            String result = jsonParser.parse(App.listUpcomingEvents, data);

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
                    Toast.makeText(UpcomingEventActivity.this, message, Toast.LENGTH_SHORT).show();

                    JSONArray jsonUpcomingEventList = jsonObject.getJSONArray("event");
                    for (int i=0;i<jsonUpcomingEventList.length();i++)
                    {

                        Event event = new Event();

                        JSONObject jsonUpcomingEvent = jsonUpcomingEventList.getJSONObject(i);
                        int event_id = jsonUpcomingEvent.getInt("event_id");
                        String title = jsonUpcomingEvent.getString("title");
                        //String purpose = jsonUpcomingEvent.getString("purpose");
                        //String address = jsonUpcomingEvent.getString("address");
                        //String city_name = jsonUpcomingEvent.getString("city_name");
                        //String state_name = jsonUpcomingEvent.getString("state_name");
                        //String contact_person = jsonUpcomingEvent.getString("contact_person");
                        //String email = jsonUpcomingEvent.getString("email");
                        //String mobile = jsonUpcomingEvent.getString("mobile");
                        String event_date = jsonUpcomingEvent.getString("event_date");
                        String event_time = jsonUpcomingEvent.getString("event_time");
                        String image = jsonUpcomingEvent.getString("image");
                        //String event_type_name = jsonUpcomingEvent.getString("event_type_name");

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

                        listUpcomingEvent.add(event);

                    }

                    UpcomingEventAdapter upcomingEventAdapter = new UpcomingEventAdapter(UpcomingEventActivity.this, listUpcomingEvent);
                    lvUpcomingEvent.setAdapter(upcomingEventAdapter);


                } else {
                    Toast.makeText(UpcomingEventActivity.this, message, Toast.LENGTH_SHORT).show();
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }
}
