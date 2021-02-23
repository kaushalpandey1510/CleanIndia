package com.example.kaushal.swachhbharat.adapter;

import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.example.kaushal.swachhbharat.EventDetailActivity;
import com.example.kaushal.swachhbharat.R;
import com.example.kaushal.swachhbharat.config.App;
import com.example.kaushal.swachhbharat.image_viewer.ImageViewer;
import com.example.kaushal.swachhbharat.model.Event;
import com.example.kaushal.swachhbharat.model.PublicPlace;
import com.example.kaushal.swachhbharat.utility.DateUtility;

import java.util.ArrayList;

public class UpcomingEventAdapter extends BaseAdapter {


    private Context context;
    private ArrayList<Event> listEvent;
    private LayoutInflater layoutInflater;

    public UpcomingEventAdapter(Context context, ArrayList<Event> listEvent) {
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

        convertView = layoutInflater.inflate(R.layout.activity_upcoming_event_custom, null);
        TextView tvUpcomingEventTitle = convertView.findViewById(R.id.tvUpcomingEventTitle);
        TextView tvUpcomingEventDate = convertView.findViewById(R.id.tvUpcomingEventDate);
        TextView tvUpcomingEventTime = convertView.findViewById(R.id.tvUpcomingEventTime);
        ImageView ivUpcomingEventImage = convertView.findViewById(R.id.ivUpcomingEventImage);
        ImageView ivViewEventDetail = convertView.findViewById(R.id.ivViewEventDetail);



        tvUpcomingEventTitle.setText("Title: " + listEvent.get(position).getTitle());
        tvUpcomingEventDate.setText("Date: " + DateUtility.formatDate(listEvent.get(position).getEvent_date()));
        tvUpcomingEventTime.setText("Time:" + DateUtility.formatTime(listEvent.get(position).getEvent_time()));

        ImageViewer imageViewer = new ImageViewer(ivUpcomingEventImage);
        imageViewer.execute(App.url + "/" + listEvent.get(position).getImage());

        ivViewEventDetail.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //Toast.makeText(context, "view detail page", Toast.LENGTH_SHORT).show();
                Intent intent = new Intent(context, EventDetailActivity.class);
                intent.putExtra("event_id", listEvent.get(position).getEvent_id());
                context.startActivity(intent);
            }
        });;

        return convertView;
    }
}
