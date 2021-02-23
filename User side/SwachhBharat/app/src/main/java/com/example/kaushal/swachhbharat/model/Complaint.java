package com.example.kaushal.swachhbharat.model;

public class Complaint {

    private String complaint_id;
    private String title;
    private String description;
    private int category_id;
    private int ministry_id;
    private String location;
    private String photo;
    private String new_photo;
    private int user_id;
    private String complaint_date;
    private String resolve;
    private String resolve_confirm;
    private String resolve_date;

    public String getComplaint_id() {
        return complaint_id;
    }

    public void setComplaint_id(String complaint_id) {
        this.complaint_id = complaint_id;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public int getCategory_id() {
        return category_id;
    }

    public void setCategory_id(int category_id) {
        this.category_id = category_id;
    }

    public int getMinistry_id() {
        return ministry_id;
    }

    public void setMinistry_id(int ministry_id) {
        this.ministry_id = ministry_id;
    }

    public String getLocation() {
        return location;
    }

    public void setLocation(String location) {
        this.location = location;
    }

    public String getPhoto() {
        return photo;
    }

    public void setPhoto(String photo) {
        this.photo = photo;
    }

    public String getNew_photo() {
        return new_photo;
    }

    public void setNew_photo(String new_photo) {
        this.new_photo = new_photo;
    }

    public int getUser_id() {
        return user_id;
    }

    public void setUser_id(int user_id) {
        this.user_id = user_id;
    }

    public String getComplaint_date() {
        return complaint_date;
    }

    public void setComplaint_date(String complaint_date) {
        this.complaint_date = complaint_date;
    }

    public String getResolve() {
        return resolve;
    }

    public void setResolve(String resolve) {
        this.resolve = resolve;
    }

    public String getResolve_confirm() {
        return resolve_confirm;
    }

    public void setResolve_confirm(String resolve_confirm) {
        this.resolve_confirm = resolve_confirm;
    }

    public String getResolve_date() {
        return resolve_date;
    }

    public void setResolve_date(String resolve_date) {
        this.resolve_date = resolve_date;
    }
}
