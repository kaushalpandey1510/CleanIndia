package com.example.kaushal.swachhbharat.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.example.kaushal.swachhbharat.R;
import com.example.kaushal.swachhbharat.model.PublicPlace;
import com.example.kaushal.swachhbharat.model.State;

import java.util.ArrayList;

public class StateAdapter extends BaseAdapter {


    private Context context;
    private ArrayList<State> listState;
    private LayoutInflater layoutInflater;

    public StateAdapter(Context context, ArrayList<State> listState) {
        this.context = context;
        this.listState= listState;
        layoutInflater = LayoutInflater.from(context);
    }

    @Override
    public int getCount() {
        return listState.size();
    }

    @Override
    public Object getItem(int position) {
        return null;
    }

    @Override
    public long getItemId(int position) {
        return 0;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {

        convertView = layoutInflater.inflate(R.layout.activity_state_custom, null);
        TextView tvStateName = convertView.findViewById(R.id.tvStateName);
        tvStateName.setText(listState.get(position).getState_name());

        return convertView;
    }
}
