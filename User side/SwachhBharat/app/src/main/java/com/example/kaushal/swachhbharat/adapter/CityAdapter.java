package com.example.kaushal.swachhbharat.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.example.kaushal.swachhbharat.R;
import com.example.kaushal.swachhbharat.model.City;
import com.example.kaushal.swachhbharat.model.State;

import java.util.ArrayList;

public class CityAdapter extends BaseAdapter {


    private Context context;
    private ArrayList<City> listCity;
    private LayoutInflater layoutInflater;

    public CityAdapter(Context context, ArrayList<City> listCity) {
        this.context = context;
        this.listCity= listCity;
        layoutInflater = LayoutInflater.from(context);
    }

    @Override
    public int getCount() {
        return listCity.size();
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

        convertView = layoutInflater.inflate(R.layout.activity_city_custom, null);
        TextView tvCityName = convertView.findViewById(R.id.tvCityName);
        tvCityName.setText(listCity.get(position).getCity_name());

        return convertView;
    }
}
