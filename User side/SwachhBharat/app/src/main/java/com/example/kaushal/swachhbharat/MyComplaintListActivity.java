package com.example.kaushal.swachhbharat;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.FrameLayout;
import android.widget.ListView;
import android.widget.Toast;

import com.example.kaushal.swachhbharat.adapter.MyComplaintListAdapter;
import com.example.kaushal.swachhbharat.config.App;
import com.example.kaushal.swachhbharat.model.Complaint;
import com.example.kaushal.swachhbharat.model.User;
import com.example.kaushal.swachhbharat.parser.JSONParser;
import com.example.kaushal.swachhbharat.preference.UserPreference;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class MyComplaintListActivity extends MainActivity {

    private ProgressDialog progressDialog;
    private ListView lvComplaint;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        FrameLayout contentFrameLayout = (FrameLayout) findViewById(R.id.content_frame); //Remember this is the FrameLayout area within your activity_main.xml
        getLayoutInflater().inflate(R.layout.activity_my_complaint_list, contentFrameLayout);
        lvComplaint = findViewById(R.id.lvComplaint);

        MyComplaint myComplaint = new MyComplaint();
        myComplaint.execute();

    }

    class MyComplaint extends AsyncTask<String, String, String>{
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            progressDialog = new ProgressDialog(MyComplaintListActivity.this);
            progressDialog.setTitle("Please wait");
            progressDialog.show();
        }

        @Override
        protected String doInBackground(String... strings) {

            UserPreference userPreference = new UserPreference(MyComplaintListActivity.this);
            User user = userPreference.get();
            int user_id = user.getUser_id();

            String data = "user_id=" + user_id;
            JSONParser jsonParser = new JSONParser();
            String result = jsonParser.parse(App.myComplaint, data);

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
                    Toast.makeText(MyComplaintListActivity.this, message, Toast.LENGTH_SHORT).show();

                    ArrayList<Complaint> listComplaint  =new ArrayList<Complaint>();
                    JSONArray jsonComplaintList = jsonObject.getJSONArray("complaint");
                    for (int i=0;i<jsonComplaintList.length();i++)
                    {

                        Complaint complaint = new Complaint();

                        JSONObject jsonComplaint = jsonComplaintList.getJSONObject(i);
                        String complaint_id = jsonComplaint.getString("complaint_id");
                        String title = jsonComplaint.getString("title");
                        String photo = jsonComplaint.getString("photo");
                        String resolve_confirm = jsonComplaint.getString("resolve_confirm");

                        complaint.setComplaint_id(complaint_id);
                        complaint.setTitle(title);
                        complaint.setResolve_confirm(resolve_confirm);
                        complaint.setPhoto(photo);

                        listComplaint.add(complaint);

                    }

                    MyComplaintListAdapter myComplaintListAdapter = new MyComplaintListAdapter(MyComplaintListActivity.this, listComplaint);
                    lvComplaint.setAdapter(myComplaintListAdapter);

                    /*
                    User user = new User();
                    user.setUser_id(jsonUser.getInt("user_id"));
                    user.setName(jsonUser.getString("name"));
                    user.setEmail(jsonUser.getString("email"));

                    UserPreference userPreference = new UserPreference(MyComplaintListActivity.this);
                    userPreference.save(user);

                    Intent intent = new Intent(MyComplaintListActivity.this, HomeActivity.class);
                    startActivity(intent);*/
                } else {
                    Toast.makeText(MyComplaintListActivity.this, message, Toast.LENGTH_SHORT).show();
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }
}


