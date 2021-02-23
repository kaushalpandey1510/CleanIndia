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

import com.example.kaushal.swachhbharat.adapter.CityAdapter;
import com.example.kaushal.swachhbharat.adapter.StateAdapter;
import com.example.kaushal.swachhbharat.config.App;
import com.example.kaushal.swachhbharat.model.City;
import com.example.kaushal.swachhbharat.model.State;
import com.example.kaushal.swachhbharat.parser.JSONParser;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;

public class CityActivity extends MainActivity implements AdapterView.OnItemClickListener {

    private ProgressDialog progressDialog;
    private ListView lvCity;
    private ArrayList<City> listCity = new ArrayList<City>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        FrameLayout contentFrameLayout = (FrameLayout) findViewById(R.id.content_frame); //Remember this is the FrameLayout area within your activity_main.xml
        getLayoutInflater().inflate(R.layout.activity_city, contentFrameLayout);

        int state_id = getIntent().getExtras().getInt("state_id");

        lvCity = findViewById(R.id.lvCity);
        LoadCity loadCity = new LoadCity();
        loadCity.execute(state_id+"");

    }

    @Override
    public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
        Toast.makeText(this, "selected", Toast.LENGTH_SHORT).show();
        Intent intent = new Intent(CityActivity.this, PublicPlaceActivity.class);
        intent.putExtra("state_id", listCity.get(position).getState_id());
        intent.putExtra("city_id", listCity.get(position).getCity_id());
        startActivity(intent);
    }

    class LoadCity extends AsyncTask<String, String, String> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            progressDialog = new ProgressDialog(CityActivity.this);
            progressDialog.setTitle("Please wait");
            progressDialog.show();
        }

        @Override
        protected String doInBackground(String... strings) {

            String state_id = strings[0];
            String data = "state_id=" + state_id;
            JSONParser jsonParser = new JSONParser();
            String result = jsonParser.parse(App.listCity, data);

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
                    Toast.makeText(CityActivity.this, message, Toast.LENGTH_SHORT).show();

                    JSONArray jsonCityList = jsonObject.getJSONArray("city");
                    for (int i = 0; i < jsonCityList.length(); i++) {

                        City city = new City();

                        JSONObject jsonCity = jsonCityList.getJSONObject(i);
                        int city_id = jsonCity.getInt("city_id");
                        String city_name = jsonCity.getString("city_name");
                        int state_id = jsonCity.getInt("state_id");
                        city.setCity_id(city_id);
                        city.setCity_name(city_name);
                        city.setState_id(state_id);
                        listCity.add(city);

                    }

                    CityAdapter cityAdapter = new CityAdapter(CityActivity.this, listCity);
                    lvCity.setAdapter(cityAdapter);
                    lvCity.setOnItemClickListener(CityActivity.this);


                } else {
                    Toast.makeText(CityActivity.this, message, Toast.LENGTH_SHORT).show();
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }
}
