package com.example.kaushal.swachhbharat.preference;

import android.content.Context;
import android.content.SharedPreferences;
import android.widget.Toast;

import com.example.kaushal.swachhbharat.model.User;

public class UserPreference {

    private  Context context;
    public UserPreference(Context context)
    {
        this.context = context;
    }

    public void save(User user)
    {

        SharedPreferences sharedPreferences = context.getSharedPreferences("user", Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.putInt("user_id", user.getUser_id());
        editor.putString("name", user.getName());
        editor.putString("email", user.getEmail());
        editor.commit();// commit is important here.
    }
    public User get()
    {
        SharedPreferences shared = context.getSharedPreferences("user", Context.MODE_PRIVATE);
        int user_id = shared.getInt("user_id", 0);
        String name = shared.getString("name", null);
        String email = shared.getString("email", null);

        User user = new User();
        user.setUser_id(user_id);
        user.setName(name);
        user.setEmail(email);

        return user;

    }

    public void clear()
    {
        SharedPreferences sharedPreferences = context.getSharedPreferences("user", Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.clear();
        editor.commit();
    }

    public boolean isNull()
    {
        SharedPreferences sharedPreferences = context.getSharedPreferences("user", Context.MODE_PRIVATE);
        String email = sharedPreferences.getString("email", null);
        //Toast.makeText(context, "Email: "+email, Toast.LENGTH_SHORT).show();
        if(email == null)
        {
            return true;
        }else{
            return false;
        }

    }
}
