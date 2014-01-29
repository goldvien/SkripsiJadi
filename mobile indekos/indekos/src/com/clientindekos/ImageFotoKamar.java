package com.clientindekos;

import java.io.IOException;
import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLConnection;

import android.app.Activity;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.Bundle;
import android.widget.ImageView;

public class ImageFotoKamar extends Activity {

	private String urlfoto, namafoto;
	private ImageView kamarfoto;

	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.image);// kota

		kamarfoto = (ImageView) findViewById(R.id.kamarimage);
		urlfoto = savedInstanceState != null ? savedInstanceState
				.getString("urlfoto") : null;
		namafoto = savedInstanceState != null ? savedInstanceState
				.getString("nama_kamar") : null;

		if (urlfoto == null) {
			Bundle extras = getIntent().getExtras();
			urlfoto = extras != null ? extras.getString("urlfoto") : null;
			namafoto = extras != null ? extras.getString("nama_kamar") : null;
		}
		setTitle("Foto kamar " + namafoto);
		Bitmap bitmap = DownloadImage(urlfoto);
		kamarfoto.setImageBitmap(bitmap);
	}

	private InputStream openHttpConnection(String urlString) throws IOException {
		InputStream in = null;
		int response = -1;
		URL url = new URL(urlString);
		URLConnection conn = url.openConnection();
		if (!(conn instanceof HttpURLConnection))
			throw new IOException("Not an HTTP Connection");
		try {
			HttpURLConnection httpConn = (HttpURLConnection) conn;
			httpConn.setAllowUserInteraction(false);
			httpConn.setInstanceFollowRedirects(true);
			httpConn.setRequestMethod("GET");
			httpConn.connect();

			response = httpConn.getResponseCode();
			if (response == HttpURLConnection.HTTP_OK) {
				in = httpConn.getInputStream();
			}
		} catch (Exception e) {
			throw new IOException("Error connecting");
		}
		return in;
	}

	private Bitmap DownloadImage(String URL) {
		// TODO Auto-generated method stub
		Bitmap bitmap = null;
		InputStream in = null;
		try {
			in = openHttpConnection(URL);
			bitmap = BitmapFactory.decodeStream(in);
			in.close();
		} catch (IOException e) {
			e.printStackTrace();
		}
		return bitmap;
	}

}
