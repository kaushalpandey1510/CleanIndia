package com.example.kaushal.swachhbharat;

import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AlertDialog;
import android.view.View;
import android.support.design.widget.NavigationView;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.MenuItem;
import android.widget.TextView;
import android.widget.Toast;

import com.example.kaushal.swachhbharat.model.User;
import com.example.kaushal.swachhbharat.preference.UserPreference;

public class MainActivity extends AppCompatActivity {

    DrawerLayout drawerLayout;
    ActionBarDrawerToggle actionBarDrawerToggle;
    Toolbar toolbar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        //  check for null shared preference



        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        View hView = navigationView.getHeaderView(0);
        //TextView tvName = hView.findViewById(R.id.tvName);
        TextView tvEmail = hView.findViewById(R.id.tvEmail);

        UserPreference userPreference = new UserPreference(MainActivity.this);
        User user = userPreference.get();



        if (user.getName() != null && !user.getName().equals("null") && user.getName().trim().length() > 0) {
            //tvName.setText(user.getName());
        }
        tvEmail.setText(user.getEmail());

        toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        drawerLayout = (DrawerLayout) findViewById(R.id.drawer_layout);

        actionBarDrawerToggle = new ActionBarDrawerToggle(
                this, drawerLayout, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawerLayout.addDrawerListener(actionBarDrawerToggle);
        //actionBarDrawerToggle.syncState();


        navigationView.setNavigationItemSelectedListener(

                new NavigationView.OnNavigationItemSelectedListener() {
                    @Override
                    public boolean onNavigationItemSelected(MenuItem item) {
                        switch (item.getItemId()) {

                            case R.id.nav_home:
                                Toast.makeText(MainActivity.this, "camera", Toast.LENGTH_LONG).show();
                                Intent upcomingEventActivityIntent = new Intent(MainActivity.this, UpcomingEventActivity.class);
                                startActivity(upcomingEventActivityIntent);
                                drawerLayout.closeDrawers();
                                break;
                            case R.id.nav_new_complaint:
                                Intent newComplaintIntent = new Intent(MainActivity.this, StateActivity.class);
                                startActivity(newComplaintIntent);
                                drawerLayout.closeDrawers();
                                break;
                            case R.id.nav_current_complaint:
                                Intent publicPlaceIntent = new Intent(MainActivity.this, MyComplaintListActivity.class);
                                startActivity(publicPlaceIntent);
                                drawerLayout.closeDrawers();
                                break;

                            case R.id.nav_accomplished_event:
                                Intent accomplishedEventIntent = new Intent(MainActivity.this, FinishedEventActivity.class);
                                startActivity(accomplishedEventIntent);
                                drawerLayout.closeDrawers();
                                break;
                            case R.id.nav_edit_profile:
                                Intent editProfileIntent = new Intent(MainActivity.this, EditProfileActivity.class);
                                startActivity(editProfileIntent);
                                drawerLayout.closeDrawers();
                                break;
                            case R.id.nav_logout:
                                //Intent logoutIntent = new Intent(MainActivity.this, LogoutActivity.class);
                                //startActivity(logoutIntent);
                                //drawerLayout.closeDrawers();
                                logout();
                                break;

                        }
                        return false;
                    }
                }
        );
    }

    @Override
    protected void onPostCreate(Bundle savedInstanceState) {
        super.onPostCreate(savedInstanceState);

        actionBarDrawerToggle.syncState();
    }

    public void logout()
    {
        DialogInterface.OnClickListener dialogClickListener = new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                switch (which){
                    case DialogInterface.BUTTON_POSITIVE:

                        UserPreference userPreference = new UserPreference(MainActivity.this);
                        userPreference.clear();
                        Toast.makeText(MainActivity.this, "You are logged out successfully.", Toast.LENGTH_SHORT).show();
                        Intent intent = new Intent(MainActivity.this, LoginActivity.class);
                        startActivity(intent);

                        break;

                    case DialogInterface.BUTTON_NEGATIVE:
                        //No button clicked
                        break;
                }
            }
        };

        AlertDialog.Builder builder = new AlertDialog.Builder(MainActivity.this);
        builder.setMessage("Do you really want to logout?");
        builder.setPositiveButton("Yes", dialogClickListener);
        builder.setNegativeButton("No", dialogClickListener);
        builder.show();
    }



    @Override
    public void onBackPressed() {
        //Intent intent = new Intent(Intent.ACTION_MAIN);
        //intent.addCategory(Intent.CATEGORY_HOME);
        //startActivity(intent);

        //super.onBackPressed();
        //Toast.makeText(this, "nice", Toast.LENGTH_SHORT).show();
        /*UserPreference userPreference = new UserPreference(MainActivity.this);
        if(userPreference.isNull())
        {
            Intent intent = new Intent(MainActivity.this, LoginActivity.class);
            startActivity(intent);
        }*/

    }
}
