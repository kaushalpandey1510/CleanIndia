package com.example.kaushal.swachhbharat.adapter;

import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Color;
import android.os.AsyncTask;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.example.kaushal.swachhbharat.R;
import com.example.kaushal.swachhbharat.config.App;
import com.example.kaushal.swachhbharat.image_viewer.ImageViewer;
import com.example.kaushal.swachhbharat.model.Complaint;

import java.io.IOException;
import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLConnection;
import java.util.ArrayList;

public class MyComplaintListAdapter extends BaseAdapter {


    private Context context;
    private ArrayList<Complaint> listComplaint;
    private LayoutInflater layoutInflater;

    public MyComplaintListAdapter(Context context, ArrayList<Complaint> listComplaint) {
        this.context = context;
        this.listComplaint = listComplaint;
        layoutInflater = LayoutInflater.from(context);
    }

    @Override
    public int getCount() {
        return listComplaint.size();
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

        convertView = layoutInflater.inflate(R.layout.activity_my_complaint_list_custom, null);
        TextView tvComplaintId = convertView.findViewById(R.id.tvComplaintId);
        TextView tvTitle = convertView.findViewById(R.id.tvTitle);
        TextView tvStatus = convertView.findViewById(R.id.tvStatus);
        ImageView ivPic = convertView.findViewById(R.id.ivPic);

        tvComplaintId.setText("Complaint Id: "+listComplaint.get(position).getComplaint_id());
        tvTitle.setText("Title: "+listComplaint.get(position).getTitle());

        if(listComplaint.get(position).getResolve_confirm().equals("1"))
        {
            tvStatus.setBackgroundColor(context.getResources().getColor(R.color.colorGreen));
            tvStatus.setTextColor(context.getResources().getColor(R.color.colorWhite));
            tvStatus.setText("Status: "+"Resolved");
        }else{
            tvStatus.setBackgroundColor(context.getResources().getColor(R.color.colorOragnge));
            tvStatus.setTextColor(context.getResources().getColor(R.color.colorWhite));
            tvStatus.setText("Status: "+"Pending");
        }


        ImageViewer imageViewer = new ImageViewer(ivPic);
        imageViewer.execute(App.url +"/"+listComplaint.get(position).getPhoto());

        return convertView;
    }




}
