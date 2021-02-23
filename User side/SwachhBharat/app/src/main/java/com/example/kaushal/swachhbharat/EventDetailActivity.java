package com.example.kaushal.swachhbharat;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.FrameLayout;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.example.kaushal.swachhbharat.adapter.FinishedEventAdapter;
import com.example.kaushal.swachhbharat.config.App;
import com.example.kaushal.swachhbharat.image_viewer.ImageViewer;
import com.example.kaushal.swachhbharat.model.Event;
import com.example.kaushal.swachhbharat.parser.JSONParser;
import com.example.kaushal.swachhbharat.utility.DateUtility;

import org.json.JSONArray;
import org.json.JSONObject;

public class EventDetailActivity extends MainActivity {

    private TextView tvEventTitle;
    private TextView tvEventDate;
    private TextView tvEventPurpose;
    private TextView tvEventAddress;
    private TextView tvEventContactPerson;
    private TextView tvEventEmail;
    private TextView tvEventMobile;
    private TextView tvEventType;
    private ImageView ivEventImage;
    private ProgressDialog progressDialog;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        FrameLayout contentFrameLayout = (FrameLayout) findViewById(R.id.content_frame); //Remember this is the FrameLayout area within your activity_main.xml
        getLayoutInflater().inflate(R.layout.activity_event_detail, contentFrameLayout);

        int event_id = getIntent().getExtras().getInt("event_id");


        tvEventTitle = findViewById(R.id.tvEventTitle);
        tvEventDate = findViewById(R.id.tvEventDate);
        tvEventPurpose = findViewById(R.id.tvEventPurpose);
        tvEventAddress = findViewById(R.id.tvEventAddress);
        tvEventContactPerson = findViewById(R.id.tvEventContactPerson);
        tvEventEmail = findViewById(R.id.tvEventEmail);
        tvEventMobile = findViewById(R.id.tvEventMobile);
        tvEventType = findViewById(R.id.tvEventType);
        ivEventImage = findViewById(R.id.ivEventImage);

        LoadEventDetail loadEventDetail = new LoadEventDetail();
        loadEventDetail.execute(event_id + "");
    }

    class LoadEventDetail extends AsyncTask<String, String, String> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            progressDialog = new ProgressDialog(EventDetailActivity.this);
            progressDialog.setTitle("Please wait");
            progressDialog.show();
        }

        @Override
        protected String doInBackground(String... strings) {

            String event_id = strings[0];
            String data = "event_id=" + event_id;
            JSONParser jsonParser = new JSONParser();
            String result = jsonParser.parse(App.eventDetail, data);

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
                    Toast.makeText(EventDetailActivity.this, message, Toast.LENGTH_SHORT).show();

                    JSONObject jsonEvent = jsonObject.getJSONObject("event");


                    //int event_id = jsonEvent.getInt("event_id");
                    String title = jsonEvent.getString("title");
                    String purpose = jsonEvent.getString("purpose");
                    String address = jsonEvent.getString("address");
                    String city_name = jsonEvent.getString("city_name");
                    String state_name = jsonEvent.getString("state_name");
                    String contact_person = jsonEvent.getString("contact_person");
                    String email = jsonEvent.getString("email");
                    String mobile = jsonEvent.getString("mobile");
                    String event_date = jsonEvent.getString("event_date");
                    String event_time = jsonEvent.getString("event_time");
                    String image = jsonEvent.getString("image");
                    String event_type_name = jsonEvent.getString("event_type_name");

                    //event.setEvent_id(event_id);
                    tvEventTitle.setText(title);
                    tvEventDate.setText(DateUtility.formatDate(event_date) + " " + DateUtility.formatTime(event_time));
                    tvEventPurpose.setText(purpose);
                    tvEventAddress.setText(address + ", " + city_name + ", " + state_name);
                    tvEventContactPerson.setText(contact_person);
                    tvEventEmail.setText(email);
                    tvEventMobile.setText(mobile);
                    tvEventType.setText(event_type_name);

                    ImageViewer imageViewer = new ImageViewer(ivEventImage);
                    imageViewer.execute(App.url + "/" + image);


                } else {
                    Toast.makeText(EventDetailActivity.this, message, Toast.LENGTH_SHORT).show();
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }

}
