package com.example.kaushal.swachhbharat;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.example.kaushal.swachhbharat.config.App;
import com.example.kaushal.swachhbharat.image_viewer.ImageViewer;
import com.example.kaushal.swachhbharat.model.User;
import com.example.kaushal.swachhbharat.parser.JSONParser;
import com.example.kaushal.swachhbharat.preference.UserPreference;
import com.example.kaushal.swachhbharat.utility.DateUtility;

import org.json.JSONObject;
import org.w3c.dom.Text;

public class EditProfileActivity extends MainActivity implements View.OnClickListener{

    private ProgressDialog progressDialog;
    private EditText etProfileName;
    private EditText etProfileAddress;
    private EditText etProfileCity;
    private EditText etProfileState;
    private EditText etProfileEmail;
    private EditText etProfileMobile;
    private Button btnProfileSubmit;
    private int user_id;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        FrameLayout contentFrameLayout = (FrameLayout) findViewById(R.id.content_frame); //Remember this is the FrameLayout area within your activity_main.xml
        getLayoutInflater().inflate(R.layout.activity_edit_profile, contentFrameLayout);

        etProfileName = findViewById(R.id.etProfileName);
        etProfileAddress = findViewById(R.id.etProfileAddress);
        etProfileCity = findViewById(R.id.etProfileCity);
        etProfileState = findViewById(R.id.etProfileState);
        etProfileEmail = findViewById(R.id.etProfileEmail);
        etProfileMobile = findViewById(R.id.etProfileMobile);
        btnProfileSubmit = findViewById(R.id.btnProfileSubmit);
        btnProfileSubmit.setOnClickListener(this);


        UserPreference userPreference = new UserPreference(EditProfileActivity.this);
        User user = userPreference.get();
        user_id = user.getUser_id();
        //Toast.makeText(this, "uesr:"+user_id, Toast.LENGTH_SHORT).show();

        LoadUserProfile loadUserProfile = new LoadUserProfile();
        loadUserProfile.execute();
    }

    class LoadUserProfile extends AsyncTask<String, String, String> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            progressDialog = new ProgressDialog(EditProfileActivity.this);
            progressDialog.setTitle("Please wait");
            progressDialog.show();
        }

        @Override
        protected String doInBackground(String... strings) {

            String data = "user_id=" + user_id;
            JSONParser jsonParser = new JSONParser();
            String result = jsonParser.parse(App.getProfile, data);

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
                    Toast.makeText(EditProfileActivity.this, message, Toast.LENGTH_SHORT).show();

                    JSONObject jsonUser = jsonObject.getJSONObject("user");


                    //int event_id = jsonEvent.getInt("event_id");
                    String name = jsonUser.getString("name");
                    String address = jsonUser.getString("address");
                    String city = jsonUser.getString("city");
                    String state = jsonUser.getString("state");
                    String email = jsonUser.getString("email");
                    String phone_number = jsonUser.getString("phone_number");

                    if(name!=null && !name.equals("null") && name.trim().length()>0)
                    {
                        etProfileName.setText(name);
                    }
                    if(address!=null && !address.equals("null") && address.trim().length()>0)
                    {
                        etProfileAddress.setText(address);
                    }
                    if(city!=null && !city.equals("null") && city.trim().length()>0)
                    {
                        etProfileCity.setText(city);
                    }
                    if(state!=null && !state.equals("null") && state.trim().length()>0)
                    {
                        etProfileState.setText(state);
                    }
                    if(email!=null && !email.equals("null") && email.trim().length()>0)
                    {
                        etProfileEmail.setText(email);
                    }
                    if(phone_number!=null && !phone_number.equals("null") && phone_number.trim().length()>0)
                    {
                        etProfileMobile.setText(phone_number);
                    }

                } else {
                    Toast.makeText(EditProfileActivity.this, message, Toast.LENGTH_SHORT).show();
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }

    public boolean validate()
    {
        if(etProfileName.getText().toString().trim().length() == 0)
        {
            Toast.makeText(this, "Please insert your name", Toast.LENGTH_SHORT).show();
            etProfileName.setText("");
            etProfileName.requestFocus();
            return false;
        }else if(etProfileAddress.getText().toString().trim().length() == 0)
        {
            Toast.makeText(this, "Please insert your address", Toast.LENGTH_SHORT).show();
            etProfileAddress.setText("");
            etProfileAddress.requestFocus();
            return false;
        }else if(etProfileCity.getText().toString().trim().length() == 0)
        {
            Toast.makeText(this, "Please insert your city", Toast.LENGTH_SHORT).show();
            etProfileCity.setText("");
            etProfileCity.requestFocus();
            return false;
        }else if(etProfileState.getText().toString().trim().length() == 0)
        {
            Toast.makeText(this, "Please insert your state", Toast.LENGTH_SHORT).show();
            etProfileState.setText("");
            etProfileState.requestFocus();
            return false;
        }else if(etProfileMobile.getText().toString().trim().length() == 0)
        {
            Toast.makeText(this, "Please insert your mobile number", Toast.LENGTH_SHORT).show();
            etProfileMobile.setText("");
            etProfileMobile.requestFocus();
            return false;
        }

        return true;
    }


    @Override
    public void onClick(View v) {

        if(validate())
        {
            UpdateUserProfile updateUserProfile = new UpdateUserProfile();
            updateUserProfile.execute();
        }
    }

    class UpdateUserProfile extends AsyncTask<String, String, String> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            progressDialog = new ProgressDialog(EditProfileActivity.this);
            progressDialog.setTitle("Please wait");
            progressDialog.show();
        }

        @Override
        protected String doInBackground(String... strings) {

            String data = "user_id=" + user_id +"&name="+etProfileName.getText().toString()+"&address="+etProfileAddress.getText().toString()+"&city="+etProfileCity.getText().toString()+"&state="+etProfileState.getText().toString()+"&email="+etProfileEmail.getText().toString()+"&phone_number="+etProfileMobile.getText().toString();
            JSONParser jsonParser = new JSONParser();
            String result = jsonParser.parse(App.updateProfile, data);
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
                    Toast.makeText(EditProfileActivity.this, message, Toast.LENGTH_SHORT).show();

                } else {
                    Toast.makeText(EditProfileActivity.this, message, Toast.LENGTH_SHORT).show();
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }
}
