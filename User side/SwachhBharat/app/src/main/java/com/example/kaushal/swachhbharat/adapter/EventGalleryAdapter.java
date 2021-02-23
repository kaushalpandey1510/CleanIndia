package com.example.kaushal.swachhbharat.adapter;

import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.kaushal.swachhbharat.EventDetailActivity;
import com.example.kaushal.swachhbharat.EventGalleryActivity;
import com.example.kaushal.swachhbharat.R;
import com.example.kaushal.swachhbharat.config.App;
import com.example.kaushal.swachhbharat.image_viewer.ImageViewer;
import com.example.kaushal.swachhbharat.model.Event;
import com.example.kaushal.swachhbharat.model.EventGallery;

import java.util.ArrayList;

public class EventGalleryAdapter extends BaseAdapter {


    private Context context;
    private ArrayList<EventGallery> listEventGallery;
    private LayoutInflater layoutInflater;

    public EventGalleryAdapter(Context context, ArrayList<EventGallery> listEventGallery) {
        this.context = context;
        this.listEventGallery = listEventGallery;
        layoutInflater = LayoutInflater.from(context);
    }

    @Override
    public int getCount() {
        return listEventGallery.size();
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
    public View getView(final int position, View convertView, ViewGroup parent) {

        convertView = layoutInflater.inflate(R.layout.activity_event_gallery_custom, null);
        ImageView ivEventGalleryImage = convertView.findViewById(R.id.ivEventGalleryImage);
        ImageViewer imageViewer = new ImageViewer(ivEventGalleryImage);
        imageViewer.execute(App.url + "/" + listEventGallery.get(position).getImage());

        return convertView;
    }
}
