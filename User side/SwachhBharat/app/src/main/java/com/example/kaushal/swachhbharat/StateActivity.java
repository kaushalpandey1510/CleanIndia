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

import com.example.kaushal.swachhbharat.adapter.PublicPlaceAdapter;
import com.example.kaushal.swachhbharat.adapter.StateAdapter;
import com.example.kaushal.swachhbharat.config.App;
import com.example.kaushal.swachhbharat.model.PublicPlace;
import com.example.kaushal.swachhbharat.model.State;
import com.example.kaushal.swachhbharat.parser.JSONParser;
import com.example.kaushal.swachhbharat.preference.UserPreference;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;

public class StateActivity extends MainActivity implements AdapterView.OnItemClickListener {

    private ProgressDialog progressDialog;
    private ListView lvState;
    private ArrayList<State> listState  =new ArrayList<State>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        FrameLayout contentFrameLayout = (FrameLayout) findViewById(R.id.content_frame); //Remember this is the FrameLayout area within your activity_main.xml
        getLayoutInflater().inflate(R.layout.activity_state, contentFrameLayout);

        lvState = findViewById(R.id.lvState);
        LoadState loadState = new LoadState();
        loadState.execute();
    }

    @Override
    public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
        Toast.makeText(this, "selected", Toast.LENGTH_SHORT).show();
        Intent intent = new Intent(StateActivity.this, CityActivity.class);
        intent.putExtra("state_id", listState.get(position).getState_id());
        startActivity(intent);
    }

    class LoadState extends AsyncTask<String, String, String> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            progressDialog = new ProgressDialog(StateActivity.this);
            progressDialog.setTitle("Please wait");
            progressDialog.show();
        }

        @Override
        protected String doInBackground(String... strings) {


            String data = "";
            JSONParser jsonParser = new JSONParser();
            String result = jsonParser.parse(App.listState, data);

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
                    Toast.makeText(StateActivity.this, message, Toast.LENGTH_SHORT).show();


                    JSONArray jsonStateList = jsonObject.getJSONArray("state");
                    for (int i=0;i<jsonStateList.length();i++)
                    {

                        State state = new State();

                        JSONObject jsonState = jsonStateList.getJSONObject(i);
                        int state_id = jsonState.getInt("state_id");
                        String state_name = jsonState.getString("state_name");

                        state.setState_id(state_id);
                        state.setState_name(state_name);
                        listState.add(state);

                    }

                    StateAdapter stateAdapter = new StateAdapter(StateActivity.this, listState);
                    lvState.setAdapter(stateAdapter);
                    lvState.setOnItemClickListener(StateActivity.this);


                } else {
                    Toast.makeText(StateActivity.this, message, Toast.LENGTH_SHORT).show();
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }
}
