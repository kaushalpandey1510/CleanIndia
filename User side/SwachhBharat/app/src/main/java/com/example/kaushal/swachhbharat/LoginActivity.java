package com.example.kaushal.swachhbharat;

import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;

import android.os.AsyncTask;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.example.kaushal.swachhbharat.config.App;
import com.example.kaushal.swachhbharat.model.User;
import com.example.kaushal.swachhbharat.parser.JSONParser;
import com.example.kaushal.swachhbharat.preference.UserPreference;

import org.json.JSONObject;

/**
 * A login screen that offers login via email/password.
 */
public class LoginActivity extends AppCompatActivity implements OnClickListener {

    private ProgressDialog progressDialog;

    private EditText etEmail;
    private EditText etPassword;
    private Button btnLogin;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        //Toast.makeText(this, "got it..", Toast.LENGTH_SHORT).show();

        etEmail = findViewById(R.id.etEmail);
        etPassword = findViewById(R.id.etPassword);
        btnLogin = findViewById(R.id.btnLogin);
        btnLogin.setOnClickListener(this);


    }

    public boolean validate()
    {
        if(etEmail.getText().toString().trim().length() == 0)
        {
            Toast.makeText(this, "Please insert your email address", Toast.LENGTH_SHORT).show();
            etEmail.setText("");
            etEmail.requestFocus();
            return false;
        }else if(etPassword.getText().toString().trim().length() == 0)
        {
            Toast.makeText(this, "Please insert your password", Toast.LENGTH_SHORT).show();
            etPassword.setText("");
            etPassword.requestFocus();
            return false;
        }

        return true;
    }

    @Override
    public void onClick(View v) {
        if(validate())
        {
            LoginValidation loginValidation = new LoginValidation();
            loginValidation.execute(etEmail.getText().toString(), etPassword.getText().toString());
        }
    }

    class LoginValidation extends AsyncTask<String, String, String> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();

            progressDialog = new ProgressDialog(LoginActivity.this);
            progressDialog.setTitle("Please wait");
            progressDialog.show();
        }

        @Override
        protected String doInBackground(String... strings) {

            String e = strings[0];
            String p = strings[1];

            String data = "email=" + e + "&password=" + p;
            JSONParser jsonParser = new JSONParser();
            String result = jsonParser.parse(App.login, data);

            return result;

        }

        @Override
        protected void onPostExecute(String output) {
            super.onPostExecute(output);
            progressDialog.cancel();
            try {
                JSONObject jsonObject = new JSONObject(output);
                int success = jsonObject.getInt("success");

                if (success == 1) {
                    String message = jsonObject.getString("msg");
                    Toast.makeText(LoginActivity.this, message, Toast.LENGTH_SHORT).show();

                    JSONObject jsonUser = jsonObject.getJSONObject("user");
                    User user = new User();
                    user.setUser_id(jsonUser.getInt("user_id"));
                    user.setName(jsonUser.getString("name"));
                    user.setEmail(jsonUser.getString("email"));

                    UserPreference userPreference = new UserPreference(LoginActivity.this);
                    userPreference.save(user);

                    Intent intent = new Intent(LoginActivity.this, UpcomingEventActivity.class);
                    startActivity(intent);
                } else {
                    register();
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }

    public void register() {
        DialogInterface.OnClickListener dialogClickListener = new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                switch (which) {
                    case DialogInterface.BUTTON_POSITIVE:

                        UserRegistration userRegistration = new UserRegistration();
                        userRegistration.execute();

                        break;

                    case DialogInterface.BUTTON_NEGATIVE:
                        //No button clicked
                        break;
                }
            }
        };

        AlertDialog.Builder builder = new AlertDialog.Builder(LoginActivity.this);
        builder.setMessage("This account does not exist. Do you really want to create it?");
        builder.setPositiveButton("Yes", dialogClickListener);
        builder.setNegativeButton("No", dialogClickListener);
        builder.show();
    }

    class UserRegistration extends AsyncTask<String, String, String> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();

            progressDialog = new ProgressDialog(LoginActivity.this);
            progressDialog.setTitle("Please wait");
            progressDialog.show();
        }

        @Override
        protected String doInBackground(String... strings) {

            String e = etEmail.getText().toString();
            String p = etPassword.getText().toString();

            String data = "email=" + e + "&password=" + p;
            JSONParser jsonParser = new JSONParser();
            String result = jsonParser.parse(App.register, data);

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
                    Toast.makeText(LoginActivity.this, message, Toast.LENGTH_SHORT).show();

                    JSONObject jsonUser = jsonObject.getJSONObject("user");
                    User user = new User();
                    user.setUser_id(jsonUser.getInt("user_id"));
                    user.setName(jsonUser.getString("name"));
                    user.setEmail(jsonUser.getString("email"));

                    UserPreference userPreference = new UserPreference(LoginActivity.this);
                    userPreference.save(user);

                    Intent intent = new Intent(LoginActivity.this, UpcomingEventActivity.class);
                    startActivity(intent);
                } else {
                    Toast.makeText(LoginActivity.this, message, Toast.LENGTH_SHORT).show();
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }

    @Override
    public void onBackPressed() {
        //super.onBackPressed();
    }
}

