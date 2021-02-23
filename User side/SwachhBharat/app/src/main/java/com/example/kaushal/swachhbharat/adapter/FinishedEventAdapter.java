package com.example.kaushal.swachhbharat.adapter;

import android.content.Context;
import android.content.Intent;
import android.text.format.DateUtils;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.example.kaushal.swachhbharat.EventDetailActivity;
import com.example.kaushal.swachhbharat.EventGalleryActivity;
import com.example.kaushal.swachhbharat.R;
import com.example.kaushal.swachhbharat.config.App;
import com.example.kaushal.swachhbharat.image_viewer.ImageViewer;
import com.example.kaushal.swachhbharat.model.Event;
import com.example.kaushal.swachhbharat.utility.DateUtility;

import java.util.ArrayList;

public class FinishedEventAdapter extends BaseAdapter {


    private Context context;
    private ArrayList<Event> listEvent;
    private LayoutInflater layoutInflater;

    public FinishedEventAdapter(Context context, ArrayList<Event> listEvent) {
        this.context = context;
        this.listEvent = listEvent;
        layoutInflater = LayoutInflater.from(context);
    }

    @Override
    public int getCount() {
        return listEvent.size();
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

        convertView = layoutInflater.inflate(R.layout.activity_finished_event_custom, null);
        TextView tvFinishedEventTitle = convertView.findViewById(R.id.tvFinishedEventTitle);
        TextView tvFinishedEventDate = convertView.findViewById(R.id.tvFinishedEventDate);
        TextView tvFinishedEventTime = convertView.findViewById(R.id.tvFinishedEventTime);
        ImageView ivFinishedEventImage = convertView.findViewById(R.id.ivFinishedEventImage);
        Button btnFinishedEventDetail = convertView.findViewById(R.id.btnFinishedEventDetail);
        Button btnFinishedEventGallery = convertView.findViewById(R.id.btnFinishedEventGallery);

        tvFinishedEventTitle.setText("Title: " + listEvent.get(position).getTitle());
        tvFinishedEventDate.setText("Date: " + DateUtility.formatDate(listEvent.get(position).getEvent_date()));
        tvFinishedEventTime.setText("Time:" +  DateUtility.formatTime(listEvent.get(position).getEvent_time()));

        ImageViewer imageViewer = new ImageViewer(ivFinishedEventImage);
        imageViewer.execute(App.url + "/" + listEvent.get(position).getImage());

        btnFinishedEventDetail.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(context, EventDetailActivity.class);
                intent.putExtra("event_id", listEvent.get(position).getEvent_id());
                context.startActivity(intent);
            }
        });

        btnFinishedEventGallery.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(context, EventGalleryActivity.class);
                intent.putExtra("event_id", listEvent.get(position).getEvent_id());
                context.startActivity(intent);
            }
        });


        return convertView;
    }
}
