package com.example.kaushal.swachhbharat;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.FrameLayout;
import android.widget.ListView;
import android.widget.Toast;
import android.widget.Toolbar;

import com.example.kaushal.swachhbharat.adapter.MyComplaintListAdapter;
import com.example.kaushal.swachhbharat.adapter.PublicPlaceAdapter;
import com.example.kaushal.swachhbharat.config.App;
import com.example.kaushal.swachhbharat.model.Complaint;
import com.example.kaushal.swachhbharat.model.PublicPlace;
import com.example.kaushal.swachhbharat.model.User;
import com.example.kaushal.swachhbharat.parser.JSONParser;
import com.example.kaushal.swachhbharat.preference.UserPreference;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;

public class PublicPlaceActivity extends MainActivity implements AdapterView.OnItemClickListener {

    private ProgressDialog progressDialog;
    private ListView lvPublicPlace;
    private ArrayList<PublicPlace> listPublicPlace = new ArrayList<PublicPlace>();
    private int state_id;
    private int city_id;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        FrameLayout contentFrameLayout = (FrameLayout) findViewById(R.id.content_frame); //Remember this is the FrameLayout area within your activity_main.xml
        getLayoutInflater().inflate(R.layout.activity_public_place, contentFrameLayout);

        state_id = getIntent().getExtras().getInt("state_id");
        city_id = getIntent().getExtras().getInt("city_id");

        lvPublicPlace = findViewById(R.id.lvPublicPlace);
        LoadPublicPlace loadPublicPlace = new LoadPublicPlace();
        loadPublicPlace.execute();

    }

    @Override
    public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
        Toast.makeText(this, "selected", Toast.LENGTH_SHORT).show();
        Intent intent = new Intent(PublicPlaceActivity.this, PostComplaintActivity.class);
        intent.putExtra("public_place_id", listPublicPlace.get(position).getPublic_place_id());
        intent.putExtra("state_id", state_id);
        intent.putExtra("city_id", city_id);
        startActivity(intent);
    }

    class LoadPublicPlace extends AsyncTask<String, String, String> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            progressDialog = new ProgressDialog(PublicPlaceActivity.this);
            progressDialog.setTitle("Please wait");
            progressDialog.show();
        }

        @Override
        protected String doInBackground(String... strings) {

            UserPreference userPreference = new UserPreference(PublicPlaceActivity.this);

            String data = "";
            JSONParser jsonParser = new JSONParser();
            String result = jsonParser.parse(App.listPublicPlace, data);

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
                    Toast.makeText(PublicPlaceActivity.this, message, Toast.LENGTH_SHORT).show();


                    JSONArray jsonPublicPlaceList = jsonObject.getJSONArray("public_place");
                    for (int i = 0; i < jsonPublicPlaceList.length(); i++) {

                        PublicPlace publicPlace = new PublicPlace();

                        JSONObject jsonPublicPlace = jsonPublicPlaceList.getJSONObject(i);
                        int public_place_id = jsonPublicPlace.getInt("public_place_id");
                        String public_place_name = jsonPublicPlace.getString("public_place_name");

                        publicPlace.setPublic_place_id(public_place_id);
                        publicPlace.setPublic_place_name(public_place_name);
                        listPublicPlace.add(publicPlace);

                    }

                    PublicPlaceAdapter publicPlaceAdapter = new PublicPlaceAdapter(PublicPlaceActivity.this, listPublicPlace);
                    lvPublicPlace.setAdapter(publicPlaceAdapter);
                    lvPublicPlace.setOnItemClickListener(PublicPlaceActivity.this);


                } else {
                    Toast.makeText(PublicPlaceActivity.this, message, Toast.LENGTH_SHORT).show();
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }
}
