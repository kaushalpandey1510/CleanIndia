package com.example.kaushal.swachhbharat.model;

public class EventGallery {
    private int event_gallery_id;
    private String image;
    private int event_id;

    public int getEvent_gallery_id() {
        return event_gallery_id;
    }

    public void setEvent_gallery_id(int event_gallery_id) {
        this.event_gallery_id = event_gallery_id;
    }

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }

    public int getEvent_id() {
        return event_id;
    }

    public void setEvent_id(int event_id) {
        this.event_id = event_id;
    }
}
