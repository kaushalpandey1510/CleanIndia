package com.example.kaushal.swachhbharat.adapter;

import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.kaushal.swachhbharat.R;
import com.example.kaushal.swachhbharat.config.App;
import com.example.kaushal.swachhbharat.model.Complaint;
import com.example.kaushal.swachhbharat.model.PublicPlace;

import java.io.InputStream;
import java.net.URL;
import java.util.ArrayList;

public class PublicPlaceAdapter extends BaseAdapter {


    private Context context;
    private ArrayList<PublicPlace> listPublicPlace;
    private LayoutInflater layoutInflater;

    public PublicPlaceAdapter(Context context, ArrayList<PublicPlace> listPublicPlace) {
        this.context = context;
        this.listPublicPlace = listPublicPlace;
        layoutInflater = LayoutInflater.from(context);
    }

    @Override
    public int getCount() {
        return listPublicPlace.size();
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

        convertView = layoutInflater.inflate(R.layout.activity_public_place_custom, null);
        TextView tvPublicPlaceName = convertView.findViewById(R.id.tvPublicPlaceName);
        tvPublicPlaceName.setText(listPublicPlace.get(position).getPublic_place_name());

        return convertView;
    }
}
