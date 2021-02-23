package com.example.kaushal.swachhbharat;

import android.Manifest;
import android.app.ProgressDialog;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.os.AsyncTask;
import android.support.v4.app.ActivityCompat;
import android.os.Bundle;
import android.util.Base64;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.ImageView;
import android.widget.Toast;

import com.example.kaushal.swachhbharat.config.App;
import com.example.kaushal.swachhbharat.model.User;
import com.example.kaushal.swachhbharat.preference.UserPreference;

import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.ByteArrayOutputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.util.HashMap;
import java.util.Map;

import javax.net.ssl.HttpsURLConnection;

public class PostComplaintActivity extends MainActivity {

    private Button btnTakePic, btnPostComplaint;
    private ImageView ivComplaintPic;
    private EditText etTitle, etDescription, etLocation;

    //EditText imageName;

    ProgressDialog progressDialog;

    Intent intent;

    public static final int RequestPermissionCode = 1;

    Bitmap bitmap;

    boolean check = true;

    String ImageFieldOnServer = "photo";
    String TitleFieldOnServer = "title";
    String DescriptionFieldOnServer = "description";
    String LocationFieldOnServer = "location";
    String PublicPlaceIdFieldOnServer = "public_place_id";
    String StateIdFieldOnServer = "state_id";
    String CityIdFieldOnServer = "city_id";
    String UserIdFieldOnServer = "user_id";
    int user_id = 0;
    int public_place_id;
    int state_id;
    int city_id;
    String ConvertImage;
    boolean pictureTaken = false;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        FrameLayout contentFrameLayout = (FrameLayout) findViewById(R.id.content_frame); //Remember this is the FrameLayout area within your activity_main.xml
        getLayoutInflater().inflate(R.layout.activity_post_complaint, contentFrameLayout);

        public_place_id = getIntent().getExtras().getInt("public_place_id");
        state_id = getIntent().getExtras().getInt("state_id");
        city_id = getIntent().getExtras().getInt("city_id");

        EnableRuntimePermissionToAccessCamera();
        etTitle = findViewById(R.id.etTitle);
        etDescription = findViewById(R.id.etDescription);
        etLocation = findViewById(R.id.etLocation);
        btnTakePic = (Button) findViewById(R.id.btnTakePic);
        ivComplaintPic = (ImageView) findViewById(R.id.ivComplaintPic);
        btnPostComplaint = (Button) findViewById(R.id.btnPostComplaint);
        //imageName = (EditText) findViewById(R.id.editText);

        btnTakePic.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(android.provider.MediaStore.ACTION_IMAGE_CAPTURE);
                startActivityForResult(intent, 100);
            }
        });

        btnPostComplaint.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //GetImageNameFromEditText = imageName.getText().toString();
                if(validate())
                {
                    UserPreference userPreference = new UserPreference(PostComplaintActivity.this);
                    User user = userPreference.get();
                    user_id = user.getUser_id();


                    ImageUploadToServerFunction();
                }


            }
        });
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        if (requestCode == 100 && resultCode == RESULT_OK) {
            Toast.makeText(this, "image received", Toast.LENGTH_LONG).show();
            bitmap = (Bitmap) data.getExtras().get("data");
            ivComplaintPic.setImageBitmap(bitmap);
            pictureTaken = true;
        }
    }

    // Requesting runtime permission to access camera.
    public void EnableRuntimePermissionToAccessCamera() {

        if (ActivityCompat.shouldShowRequestPermissionRationale(PostComplaintActivity.this,
                Manifest.permission.CAMERA)) {
            // Printing toast message after enabling runtime permission.
            Toast.makeText(PostComplaintActivity.this, "CAMERA permission allows us to Access CAMERA app", Toast.LENGTH_LONG).show();
        } else {
            ActivityCompat.requestPermissions(PostComplaintActivity.this, new String[]{Manifest.permission.CAMERA}, RequestPermissionCode);
        }
    }

    // Upload captured image online on server function.
    public void ImageUploadToServerFunction() {

        ByteArrayOutputStream byteArrayOutputStreamObject;

        byteArrayOutputStreamObject = new ByteArrayOutputStream();

        // Converting bitmap image to jpeg format, so by default image will upload in jpeg format.
        bitmap.compress(Bitmap.CompressFormat.JPEG, 100, byteArrayOutputStreamObject);

        byte[] byteArrayVar = byteArrayOutputStreamObject.toByteArray();

        ConvertImage = Base64.encodeToString(byteArrayVar, Base64.DEFAULT);

        class AsyncTaskUploadClass extends AsyncTask<Void, Void, String> {

            @Override
            protected void onPreExecute() {

                super.onPreExecute();

                // Showing progress dialog at image upload time.
                progressDialog = ProgressDialog.show(PostComplaintActivity.this, "Image is Uploading", "Please Wait", false, false);
            }

            @Override
            protected void onPostExecute(String output) {

                super.onPostExecute(output);

                // Dismiss the progress dialog after done uploading.
                progressDialog.dismiss();

                try {
                    JSONObject jsonObject = new JSONObject(output);
                    int success = jsonObject.getInt("success");
                    String message = jsonObject.getString("msg");
                    if (success == 1) {
                        Toast.makeText(PostComplaintActivity.this, message, Toast.LENGTH_LONG).show();
                        Intent intent = new Intent(PostComplaintActivity.this, MyComplaintListActivity.class);
                        startActivity(intent);
                    } else {
                        Toast.makeText(PostComplaintActivity.this, message, Toast.LENGTH_LONG).show();
                    }

                } catch (Exception e) {
                    e.printStackTrace();
                }


                // Printing uploading success message coming from server on android app.


                // Setting image as transparent after done uploading.
                //ivComplaintPic.setImageResource(android.R.color.transparent);


            }

            @Override
            protected String doInBackground(Void... params) {

                ImageProcessClass imageProcessClass = new ImageProcessClass();

                HashMap<String, String> HashMapParams = new HashMap<String, String>();

                HashMapParams.put(TitleFieldOnServer, etTitle.getText().toString());
                HashMapParams.put(DescriptionFieldOnServer, etDescription.getText().toString());
                HashMapParams.put(LocationFieldOnServer, etLocation.getText().toString());
                HashMapParams.put(ImageFieldOnServer, ConvertImage);
                HashMapParams.put(UserIdFieldOnServer, user_id + "");
                HashMapParams.put(PublicPlaceIdFieldOnServer, public_place_id + "");
                HashMapParams.put(StateIdFieldOnServer, state_id + "");
                HashMapParams.put(CityIdFieldOnServer, city_id + "");

                String FinalData = imageProcessClass.ImageHttpRequest(App.newComplaint, HashMapParams);

                return FinalData;
            }
        }
        AsyncTaskUploadClass AsyncTaskUploadClassOBJ = new AsyncTaskUploadClass();

        AsyncTaskUploadClassOBJ.execute();
    }

    public class ImageProcessClass {

        public String ImageHttpRequest(String requestURL, HashMap<String, String> PData) {

            StringBuilder stringBuilder = new StringBuilder();

            try {

                URL url;
                HttpURLConnection httpURLConnectionObject;
                OutputStream OutPutStream;
                BufferedWriter bufferedWriterObject;
                BufferedReader bufferedReaderObject;
                int RC;

                url = new URL(requestURL);

                httpURLConnectionObject = (HttpURLConnection) url.openConnection();

                httpURLConnectionObject.setReadTimeout(19000);

                httpURLConnectionObject.setConnectTimeout(19000);

                httpURLConnectionObject.setRequestMethod("POST");

                httpURLConnectionObject.setDoInput(true);

                httpURLConnectionObject.setDoOutput(true);

                OutPutStream = httpURLConnectionObject.getOutputStream();

                bufferedWriterObject = new BufferedWriter(

                        new OutputStreamWriter(OutPutStream, "UTF-8"));

                bufferedWriterObject.write(bufferedWriterDataFN(PData));

                bufferedWriterObject.flush();

                bufferedWriterObject.close();

                OutPutStream.close();

                RC = httpURLConnectionObject.getResponseCode();

                if (RC == HttpsURLConnection.HTTP_OK) {

                    bufferedReaderObject = new BufferedReader(new InputStreamReader(httpURLConnectionObject.getInputStream()));

                    stringBuilder = new StringBuilder();

                    String RC2;

                    while ((RC2 = bufferedReaderObject.readLine()) != null) {

                        stringBuilder.append(RC2);
                    }
                }

            } catch (Exception e) {
                e.printStackTrace();
            }
            return stringBuilder.toString();
        }

        private String bufferedWriterDataFN(HashMap<String, String> HashMapParams) throws UnsupportedEncodingException {

            StringBuilder stringBuilderObject;

            stringBuilderObject = new StringBuilder();

            for (Map.Entry<String, String> KEY : HashMapParams.entrySet()) {

                if (check)

                    check = false;
                else
                    stringBuilderObject.append("&");

                stringBuilderObject.append(URLEncoder.encode(KEY.getKey(), "UTF-8"));

                stringBuilderObject.append("=");

                stringBuilderObject.append(URLEncoder.encode(KEY.getValue(), "UTF-8"));
            }

            return stringBuilderObject.toString();
        }

    }

    public boolean validate() {
        //Toast.makeText(this, ivComplaintPic.getDrawable().toString(), Toast.LENGTH_SHORT).show();
        if (!pictureTaken) {
            Toast.makeText(this, "Please take a picture of complaint", Toast.LENGTH_SHORT).show();
            return false;
        } else if (etTitle.getText().toString().trim().length() == 0) {
            Toast.makeText(this, "Please insert complaint title", Toast.LENGTH_SHORT).show();
            etTitle.setText("");
            etTitle.requestFocus();
            return false;
        } else if (etDescription.getText().toString().trim().length() == 0) {
            Toast.makeText(this, "Please insert complaint description", Toast.LENGTH_SHORT).show();
            etDescription.setText("");
            etDescription.requestFocus();
            return false;
        } else if (etLocation.getText().toString().trim().length() == 0) {
            Toast.makeText(this, "Please insert complaint address", Toast.LENGTH_SHORT).show();
            etLocation.setText("");
            etLocation.requestFocus();
            return false;
        }

        return true;
    }

    @Override
    public void onRequestPermissionsResult(int RC, String per[], int[] PResult) {

        switch (RC) {

            case RequestPermissionCode:

                if (PResult.length > 0 && PResult[0] == PackageManager.PERMISSION_GRANTED) {

                    Toast.makeText(PostComplaintActivity.this, "Permission Granted, Now your application can access CAMERA.", Toast.LENGTH_LONG).show();

                } else {

                    Toast.makeText(PostComplaintActivity.this, "Permission Canceled, Now your application cannot access CAMERA.", Toast.LENGTH_LONG).show();

                }
                break;
        }
    }

}
