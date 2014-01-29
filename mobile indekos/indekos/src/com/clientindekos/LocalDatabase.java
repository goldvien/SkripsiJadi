package com.clientindekos;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.SQLException;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.util.Log;

public class LocalDatabase {
	/* === PEMILIK === */
	public static final String KEY_ROWID = "_id";
	public static final String KEY_PEMILIK_ID = "pemilik_id";
	public static final String KEY_PEMILIK_NO_HP = "pemilik_no_hp";
	/* === PROVINSI === */
	public static final String KEY_PROVINSI_ID = "provinsi_id";
	public static final String KEY_PROVINSI_NAMA = "provinsi_nama";
	public static final String KEY_PROVINSI_KODE = "provinsi_kode";
	/* === KOTA === */
	public static final String KEY_KAB_KOTA_ID = "kab_kota_id";
	public static final String KEY_KAB_KOTA_KODE = "kab_kota_kode";
	public static final String KEY_KAB_KOTA_NAMA = "kab_kota_nama";
	public static final String KEY_KAB_KOTA_LONG = "kab_kota_long";
	public static final String KEY_KAB_KOTA_LAT = "kab_kota_lat";
	/* === INDEKOS === */
	public static final String KEY_INDEKOS_ID = "indekos_id";
	public static final String KEY_INDEKOS_NAMA = "indekos_nama";
	public static final String KEY_INDEKOS_UNTUK = "indekos_untuk";
	public static final String KEY_INDEKOS_KETERANGAN = "indekos_keterangan";
	public static final String KEY_INDEKOS_LONG = "indekos_long";
	public static final String KEY_INDEKOS_LAT = "indekos_lat";
	public static final String KEY_INDEKOS_KAB_KOTA_JARAK = "indekos_kab_kota_jarak";
	/* === KAMAR === */
	public static final String KEY_KAMAR_ID = "kamar_id";
	public static final String KEY_KAMAR_NAMA = "kamar_nama";
	public static final String KEY_KAMAR_HARGA = "kamar_harga";
	public static final String KEY_KAMAR_ISI = "kamar_isi";
	public static final String KEY_KAMAR_UKURAN_PANJANG = "kamar_ukuran_panjang";
	public static final String KEY_KAMAR_UKURAN_LEBAR = "kamar_ukuran_lebar";
	public static final String KEY_KAMAR_UKURAN_JENIS = "kamar_ukuran_jenis";
	public static final String KEY_KAMAR_FOTO = "kamar_foto";
	public static final String KEY_KAMAR_MINIMAL_KONTRAK = "kamar_minimal_kontrak";
	public static final String KEY_KAMAR_MINIMAL_KONTRAK_JENIS = "kamar_minimal_kontrak_jenis";
	public static final String KEY_KAMAR_KONTRAK_STATUS = "kamar_kontrak_status";
	public static final String KEY_KAMAR_KONTRAK_DARI_TANGGAL = "kamar_kontrak_dari_tanggal";
	public static final String KEY_KAMAR_KONTRAK_SAMPAI_TANGGAL = "kamar_kontrak_sampai_tanggal";
	/* === FASILITAS_MASTER === */
	public static final String KEY_FASILITAS_MASTER_ID = "fasilitas_master_id";
	public static final String KEY_FASILITAS_MASTER_NAMA = "fasilitas_master_nama";
	public static final String KEY_FASILITAS_MASTER_ICON = "fasilitas_master_icon";
	/* === FASILITAS_EKS === */
	public static final String KEY_FASILITAS_EKS_ID = "fasilitas_eks_id";
	public static final String KEY_FASILITAS_EKS_NAMA = "fasilitas_eks_nama";
	public static final String KEY_FASILITAS_EKS_LONG = "fasilitas_eks_long";
	public static final String KEY_FASILITAS_EKS_LAT = "fasilitas_eks_lat";
	/* === FASILITAS_INT === */
	public static final String KEY_FASILITAS_INT_ID = "fasilitas_int_id";
	public static final String KEY_FASILITAS_INT_NAMA = "fasilitas_int_nama";
	/* === INDEKOS_FASILITAS_EKS === */
	public static final String KEY_INDEKOS_FASILITAS_EKS_ID = "indekos_fasilitas_eks_id";
	public static final String KEY_INDEKOS_FASILITAS_EKS_JARAK = "indekos_fasilitas_eks_jarak";
	/* === KAMAR_FASILITAS_INT === */
	public static final String KEY_KAMAR_FASILITAS_INT_ID = "kamar_fasilitas_int_id";

	public static final String KEY_JARAK = "jarak";
	public static final String KEY_JUMLAH = "jumlah";

	private static final String TAG = "LocalDatabase";
	private DatabaseHelper mDbHelper;
	private SQLiteDatabase mDb;

	private static final String DATABASE_NAMA = "db_indekos";
	private static final String TABEL_PROVINSI = "provinsi";
	private static final String TABEL_KAB_KOTA = "kab_kota";
	private static final String TABEL_PEMILIK = "pemilik";
	private static final String TABEL_INDEKOS = "indekos";
	private static final String TABEL_KAMAR = "kamar";
	private static final String TABEL_FASILITAS_MASTER = "fasilitas_master";
	private static final String TABEL_FASILITAS_EKS = "fasilitas_eks";
	private static final String TABEL_FASILITAS_INT = "fasilitas_int";
	private static final String TABEL_INDEKOS_FASILITAS_EKS = "indekos_fasilitas_eks";
	private static final String TABEL_KAMAR_FASILITAS_INT = "kamar_fasilitas_int";
	private static final String TABEL_JARAK_TERDEKAT = "jarak_terdekat";
	private static final int DATABASE_VERSI = 2;
	private final Context mCtx;

	private static class DatabaseHelper extends SQLiteOpenHelper {

		DatabaseHelper(Context context) {
			// TODO Auto-generated constructor stub
			super(context, DATABASE_NAMA, null, DATABASE_VERSI);

		}

		@Override
		public void onCreate(SQLiteDatabase db) {
			// TODO Auto-generated method stub
			db.execSQL("CREATE TABLE provinsi(_id integer primary key autoincrement, provinsi_id integer,provinsi_kode integer, provinsi_nama text);");
			db.execSQL("CREATE TABLE kab_kota(_id integer primary key autoincrement,kab_kota_id integer, provinsi_id integer, kab_kota_kode integer,kab_kota_nama text, kab_kota_long text, kab_kota_lat text);");
			db.execSQL("CREATE TABLE indekos(_id integer primary key autoincrement, indekos_id integer, pemilik_id integer,kab_kota_id integer,indekos_nama text, indekos_untuk text, indekos_keterangan text,indekos_long text, indekos_lat text,indekos_kab_kota_jarak integer);");
			db.execSQL("CREATE TABLE kamar(_id integer primary key autoincrement,kamar_id integer, indekos_id integer, kamar_nama text, kamar_harga text, kamar_isi text,kamar_ukuran_panjang text, kamar_ukuran_lebar text, kamar_ukuran_jenis text ,kamar_foto text, kamar_minimal_kontrak text, kamar_minimal_kontrak_jenis text,kamar_kontrak_status text,kamar_kontrak_dari_tanggal text,kamar_kontrak_sampai_tanggal text);");
			db.execSQL("CREATE TABLE fasilitas_master(_id integer primary key autoincrement,fasilitas_master_id integer, fasilitas_master_nama text,fasilitas_master_icon text);");
			db.execSQL("CREATE TABLE fasilitas_eks(_id integer primary key autoincrement,fasilitas_eks_id integer,fasilitas_master_id integer,kab_kota_id integer, fasilitas_eks_nama text,fasilitas_eks_long text,fasilitas_eks_lat text);");
			db.execSQL("CREATE TABLE fasilitas_int(_id integer primary key autoincrement,fasilitas_int_id integer, pemilik_id integer, fasilitas_int_nama text);");
			db.execSQL("CREATE TABLE indekos_fasilitas_eks(_id integer primary key autoincrement,indekos_fasilitas_eks_id integer, indekos_id integer, fasilitas_eks_id integer,indekos_fasilitas_eks_jarak integer);");
			db.execSQL("CREATE TABLE kamar_fasilitas_int(_id integer primary key autoincrement,kamar_fasilitas_int_id integer, kamar_id integer, fasilitas_int_id integer);");
			db.execSQL("CREATE TABLE jarak_terdekat(_id integer primary key autoincrement, indekos_id integer, jarak integer);");
			db.execSQL("CREATE TABLE pemilik(_id integer primary key autoincrement, pemilik_id integer, pemilik_no_hp integer);");
		}

		@Override
		public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
			// TODO Auto-generated method stub
			Log.w(TAG, "Upgrading database dari " + oldVersion + " ke "
					+ newVersion
					+ ", upgrading akan menghapus semua data yang ada.");
			db.execSQL("Drop table if exists provinsi");
			db.execSQL("Drop table if exists kab_kota");
			db.execSQL("Drop table if exists indekos");
			db.execSQL("Drop table if exists kamar");
			db.execSQL("Drop table if exists fasilitas_master");
			db.execSQL("Drop table if exists fasilitas_eks");
			db.execSQL("Drop table if exists fasilitas_int");
			db.execSQL("Drop table if exists indekos_fasilitas_eks");
			db.execSQL("Drop table if exists kamar_fasilitas_int");
			db.execSQL("Drop table if exists jarak_terdekat");
			db.execSQL("Drop table if exists pemilik");
			onCreate(db);
		}

	}

	public LocalDatabase(Context ctx) {
		this.mCtx = ctx;
	}

	public LocalDatabase open() throws SQLException {

		mDbHelper = new DatabaseHelper(mCtx);
		mDb = mDbHelper.getWritableDatabase();
		return this;
	}

	public void close() {
		mDbHelper.close();
	}

	/* === AMBIL DATA UNTUK SINKRONISASI === */
	public Cursor select_all_provinsi() {
		return mDb.query(TABEL_PROVINSI, new String[] { KEY_ROWID,
				KEY_PROVINSI_ID, KEY_PROVINSI_KODE, KEY_PROVINSI_NAMA }, null,
				null, null, null, KEY_PROVINSI_NAMA);
	}

	public Cursor select_all_pemilik() {
		return mDb.query(TABEL_PEMILIK, new String[] { KEY_ROWID,
				KEY_PEMILIK_ID, KEY_PEMILIK_NO_HP }, null, null, null, null,
				KEY_PEMILIK_ID);
	}

	public Cursor select_all_kab_kota() {
		Cursor select = mDb.query(TABEL_KAB_KOTA, new String[] { KEY_ROWID,
				KEY_KAB_KOTA_ID, KEY_PROVINSI_ID, KEY_KAB_KOTA_KODE,
				KEY_KAB_KOTA_NAMA, KEY_KAB_KOTA_LONG, KEY_KAB_KOTA_LAT }, null,
				null, null, null, KEY_KAB_KOTA_NAMA);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor select_all_indekos() {
		Cursor select = mDb.query(TABEL_INDEKOS,
				new String[] { KEY_ROWID, KEY_INDEKOS_ID, KEY_PEMILIK_ID,
						KEY_KAB_KOTA_ID, KEY_INDEKOS_NAMA, KEY_INDEKOS_UNTUK,
						KEY_INDEKOS_KETERANGAN, KEY_INDEKOS_LONG,
						KEY_INDEKOS_LAT, KEY_INDEKOS_KAB_KOTA_JARAK }, null,
				null, null, null, KEY_INDEKOS_NAMA);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor select_all_kamar() {
		Cursor select = mDb.query(TABEL_KAMAR, new String[] { KEY_ROWID,
				KEY_KAMAR_ID, KEY_INDEKOS_ID, KEY_KAMAR_NAMA, KEY_KAMAR_HARGA,
				KEY_KAMAR_ISI, KEY_KAMAR_UKURAN_PANJANG,
				KEY_KAMAR_UKURAN_LEBAR, KEY_KAMAR_UKURAN_JENIS, KEY_KAMAR_FOTO,
				KEY_KAMAR_MINIMAL_KONTRAK, KEY_KAMAR_MINIMAL_KONTRAK_JENIS,
				KEY_KAMAR_KONTRAK_STATUS, KEY_KAMAR_KONTRAK_DARI_TANGGAL,
				KEY_KAMAR_KONTRAK_SAMPAI_TANGGAL }, null, null, null, null,
				KEY_KAMAR_NAMA);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor select_all_fasilitas_master() {
		Cursor select = mDb.query(TABEL_FASILITAS_MASTER, new String[] {
				KEY_ROWID, KEY_FASILITAS_MASTER_ID, KEY_FASILITAS_MASTER_NAMA,
				KEY_FASILITAS_MASTER_ICON }, null, null, null, null,
				KEY_FASILITAS_MASTER_NAMA);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor select_all_fasilitas_eks() {
		Cursor select = mDb.query(TABEL_FASILITAS_EKS, new String[] {
				KEY_ROWID, KEY_FASILITAS_EKS_ID, KEY_FASILITAS_MASTER_ID,
				KEY_KAB_KOTA_ID, KEY_FASILITAS_EKS_NAMA,
				KEY_FASILITAS_EKS_LONG, KEY_FASILITAS_EKS_LAT }, null, null,
				null, null, KEY_FASILITAS_EKS_NAMA);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor select_all_fasilitas_int() {
		Cursor select = mDb.query(TABEL_FASILITAS_INT, new String[] {
				KEY_ROWID, KEY_FASILITAS_INT_ID, KEY_PEMILIK_ID,
				KEY_FASILITAS_INT_NAMA }, null, null, null, null,
				KEY_FASILITAS_INT_NAMA);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor select_all_indekos_fasilitas_eks() {
		Cursor select = mDb.query(TABEL_INDEKOS_FASILITAS_EKS, new String[] {
				KEY_ROWID, KEY_INDEKOS_FASILITAS_EKS_ID, KEY_INDEKOS_ID,
				KEY_FASILITAS_EKS_ID, KEY_INDEKOS_FASILITAS_EKS_JARAK }, null,
				null, null, null, KEY_INDEKOS_FASILITAS_EKS_ID);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor select_all_kamar_fasilitas_int() {
		Cursor select = mDb.query(TABEL_KAMAR_FASILITAS_INT, new String[] {
				KEY_ROWID, KEY_KAMAR_FASILITAS_INT_ID, KEY_KAMAR_ID,
				KEY_FASILITAS_INT_ID }, null, null, null, null,
				KEY_KAMAR_FASILITAS_INT_ID);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor select_all_jarak_terdekat() {
		Cursor select = mDb.rawQuery("SELECT * FROM jarak_terdekat", null);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	/* === END AMBIL DATA SINKRONISASI === */
	// Update sinkronisasi data.

	public boolean updateProvinsi(String provinsi_id, String provinsi_kode,
			String provinsi_nama) {
		ContentValues args = new ContentValues();
		args.put(KEY_PROVINSI_ID, provinsi_id);
		args.put(KEY_PROVINSI_KODE, provinsi_kode);
		args.put(KEY_PROVINSI_NAMA, provinsi_nama);
		return mDb.update(TABEL_PROVINSI, args, KEY_PROVINSI_ID + "="
				+ provinsi_id, null) > 0;
	}

	public boolean updatePemilik(String pemilik_id, String pemilik_no_hp) {
		ContentValues args = new ContentValues();
		args.put(KEY_PEMILIK_ID, pemilik_id);
		args.put(KEY_PEMILIK_NO_HP, pemilik_no_hp);
		return mDb.update(TABEL_PEMILIK, args, KEY_PEMILIK_ID + "="
				+ pemilik_id, null) > 0;
	}

	public boolean updateKabKota(String kab_kota_id, String provinsi_id,
			String kab_kota_kode, String kab_kota_nama, String kab_kota_long,
			String kab_kota_lat) {
		ContentValues args = new ContentValues();
		args.put(KEY_KAB_KOTA_ID, kab_kota_id);
		args.put(KEY_PROVINSI_ID, provinsi_id);
		args.put(KEY_KAB_KOTA_KODE, kab_kota_kode);
		args.put(KEY_KAB_KOTA_NAMA, kab_kota_nama);
		args.put(KEY_KAB_KOTA_LONG, kab_kota_long);
		args.put(KEY_KAB_KOTA_LAT, kab_kota_lat);
		return mDb.update(TABEL_KAB_KOTA, args, KEY_KAB_KOTA_ID + "="
				+ kab_kota_id, null) > 0;
	}

	public boolean updateIndekos(String indekos_id, String pemilik_id,
			String kab_kota_id, String indekos_nama, String indekos_untuk,
			String indekos_keterangan, String indekos_long, String indekos_lat,
			String indekos_kab_kota_jarak) {
		ContentValues args = new ContentValues();
		args.put(KEY_INDEKOS_ID, indekos_id);
		args.put(KEY_PEMILIK_ID, pemilik_id);
		args.put(KEY_KAB_KOTA_ID, kab_kota_id);
		args.put(KEY_INDEKOS_NAMA, indekos_nama);
		args.put(KEY_INDEKOS_UNTUK, indekos_untuk);
		args.put(KEY_INDEKOS_KETERANGAN, indekos_keterangan);
		args.put(KEY_INDEKOS_LONG, indekos_long);
		args.put(KEY_INDEKOS_LAT, indekos_lat);
		args.put(KEY_INDEKOS_KAB_KOTA_JARAK, indekos_kab_kota_jarak);
		return mDb.update(TABEL_INDEKOS, args, KEY_INDEKOS_ID + "="
				+ indekos_id, null) > 0;
	}

	public boolean updateKamar(String kamar_id, String indekos_id,
			String kamar_nama, String kamar_harga, String kamar_isi,
			String kamar_ukuran_panjang, String kamar_ukuran_lebar,
			String kamar_ukuran_jenis, String kamar_foto,
			String kamar_minimal_kontrak, String kamar_minimal_kontrak_jenis,
			String kamar_kontrak_status, String kamar_kontrak_dari_tanggal,
			String kamar_kontrak_sampai_tanggal) {
		ContentValues args = new ContentValues();
		args.put(KEY_KAMAR_ID, kamar_id);
		args.put(KEY_INDEKOS_ID, indekos_id);
		args.put(KEY_KAMAR_NAMA, kamar_nama);
		args.put(KEY_KAMAR_HARGA, kamar_harga);
		args.put(KEY_KAMAR_ISI, kamar_isi);
		args.put(KEY_KAMAR_UKURAN_PANJANG, kamar_ukuran_panjang);
		args.put(KEY_KAMAR_UKURAN_LEBAR, kamar_ukuran_lebar);
		args.put(KEY_KAMAR_UKURAN_JENIS, kamar_ukuran_jenis);
		args.put(KEY_KAMAR_FOTO, kamar_foto);
		args.put(KEY_KAMAR_MINIMAL_KONTRAK, kamar_minimal_kontrak);
		args.put(KEY_KAMAR_MINIMAL_KONTRAK_JENIS, kamar_minimal_kontrak_jenis);
		args.put(KEY_KAMAR_KONTRAK_STATUS, kamar_kontrak_status);
		args.put(KEY_KAMAR_KONTRAK_DARI_TANGGAL, kamar_kontrak_dari_tanggal);
		args.put(KEY_KAMAR_KONTRAK_SAMPAI_TANGGAL, kamar_kontrak_sampai_tanggal);
		return mDb.update(TABEL_KAMAR, args, KEY_KAMAR_ID + "=" + kamar_id,
				null) > 0;
	}

	public boolean updateFasilitasMaster(String fasilitas_master_id,
			String fasilitas_master_nama, String fasilitas_master_icon) {
		ContentValues args = new ContentValues();
		args.put(KEY_FASILITAS_MASTER_ID, fasilitas_master_id);
		args.put(KEY_FASILITAS_MASTER_NAMA, fasilitas_master_nama);
		args.put(KEY_FASILITAS_MASTER_ICON, fasilitas_master_icon);
		return mDb.update(TABEL_FASILITAS_MASTER, args, KEY_FASILITAS_MASTER_ID
				+ "=" + fasilitas_master_id, null) > 0;
	}

	public boolean updateFasilitasEks(String fasilitas_eks_id,
			String fasilitas_master_id, String kab_kota_id,
			String fasilitas_eks_nama, String fasilitas_eks_long,
			String fasilitas_eks_lat) {
		ContentValues args = new ContentValues();
		args.put(KEY_FASILITAS_EKS_ID, fasilitas_eks_id);
		args.put(KEY_FASILITAS_MASTER_ID, fasilitas_master_id);
		args.put(KEY_KAB_KOTA_ID, kab_kota_id);
		args.put(KEY_FASILITAS_EKS_NAMA, fasilitas_eks_nama);
		args.put(KEY_FASILITAS_EKS_LONG, fasilitas_eks_long);
		args.put(KEY_FASILITAS_EKS_LAT, fasilitas_eks_lat);
		return mDb.update(TABEL_FASILITAS_EKS, args, KEY_FASILITAS_EKS_ID + "="
				+ fasilitas_eks_id, null) > 0;
	}

	public boolean updateFasilitasInt(String fasilitas_int_id,
			String pemilik_id, String fasilitas_int_nama) {
		ContentValues args = new ContentValues();
		args.put(KEY_FASILITAS_INT_ID, fasilitas_int_id);
		args.put(KEY_PEMILIK_ID, pemilik_id);
		args.put(KEY_FASILITAS_INT_NAMA, fasilitas_int_nama);
		return mDb.update(TABEL_FASILITAS_INT, args, KEY_FASILITAS_INT_ID + "="
				+ fasilitas_int_id, null) > 0;
	}

	public boolean updateIndekosFasilitasEks(String indekos_fasilitas_eks_id,
			String indekos_id, String fasilitas_eks_id,
			String indekos_fasilitas_eks_jarak) {
		ContentValues args = new ContentValues();
		args.put(KEY_INDEKOS_FASILITAS_EKS_ID, indekos_fasilitas_eks_id);
		args.put(KEY_INDEKOS_ID, indekos_id);
		args.put(KEY_FASILITAS_EKS_ID, fasilitas_eks_id);
		args.put(KEY_INDEKOS_FASILITAS_EKS_JARAK, indekos_fasilitas_eks_jarak);
		return mDb.update(TABEL_INDEKOS_FASILITAS_EKS, args,
				KEY_INDEKOS_FASILITAS_EKS_ID + "=" + indekos_fasilitas_eks_id,
				null) > 0;
	}

	public boolean updateKamarFasilitasInt(String kamar_fasilitas_int_id,
			String kamar_id, String fasilitas_int_id) {
		ContentValues args = new ContentValues();
		args.put(KEY_KAMAR_FASILITAS_INT_ID, kamar_fasilitas_int_id);
		args.put(KEY_KAMAR_ID, kamar_id);
		args.put(KEY_FASILITAS_INT_ID, fasilitas_int_id);
		return mDb
				.update(TABEL_KAMAR_FASILITAS_INT, args,
						KEY_KAMAR_FASILITAS_INT_ID + "="
								+ kamar_fasilitas_int_id, null) > 0;
	}

	// Insert sinkronisasi data.

	public long insertProvinsi(String provinsi_id, String provinsi_kode,
			String provinsi_nama) {
		ContentValues args = new ContentValues();
		args.put(KEY_ROWID, provinsi_id);
		args.put(KEY_PROVINSI_ID, provinsi_id);
		args.put(KEY_PROVINSI_KODE, provinsi_kode);
		args.put(KEY_PROVINSI_NAMA, provinsi_nama);
		return mDb.insert(TABEL_PROVINSI, null, args);
	}

	public long insertPemilik(String pemilik_id, String pemilik_no_hp) {
		ContentValues args = new ContentValues();
		args.put(KEY_ROWID, pemilik_id);
		args.put(KEY_PEMILIK_ID, pemilik_id);
		args.put(KEY_PEMILIK_NO_HP, pemilik_no_hp);
		return mDb.insert(TABEL_PEMILIK, null, args);
	}

	public long insertKabKota(String kab_kota_id, String provinsi_id,
			String kab_kota_kode, String kab_kota_nama, String kab_kota_long,
			String kab_kota_lat) {
		ContentValues args = new ContentValues();
		args.put(KEY_ROWID, kab_kota_id);
		args.put(KEY_KAB_KOTA_ID, kab_kota_id);
		args.put(KEY_PROVINSI_ID, provinsi_id);
		args.put(KEY_KAB_KOTA_KODE, kab_kota_kode);
		args.put(KEY_KAB_KOTA_NAMA, kab_kota_nama);
		args.put(KEY_KAB_KOTA_LONG, kab_kota_long);
		args.put(KEY_KAB_KOTA_LAT, kab_kota_lat);
		return mDb.insert(TABEL_KAB_KOTA, null, args);
	}

	public long insertIndekos(String indekos_id, String pemilik_id,
			String kab_kota_id, String indekos_nama, String indekos_untuk,
			String indekos_keterangan, String indekos_long, String indekos_lat,
			String indekos_kab_kota_jarak) {
		ContentValues args = new ContentValues();
		args.put(KEY_ROWID, indekos_id);
		args.put(KEY_INDEKOS_ID, indekos_id);
		args.put(KEY_PEMILIK_ID, pemilik_id);
		args.put(KEY_KAB_KOTA_ID, kab_kota_id);
		args.put(KEY_INDEKOS_NAMA, indekos_nama);
		args.put(KEY_INDEKOS_UNTUK, indekos_untuk);
		args.put(KEY_INDEKOS_KETERANGAN, indekos_keterangan);
		args.put(KEY_INDEKOS_LONG, indekos_long);
		args.put(KEY_INDEKOS_LAT, indekos_lat);
		args.put(KEY_INDEKOS_KAB_KOTA_JARAK, indekos_kab_kota_jarak);
		return mDb.insert(TABEL_INDEKOS, null, args);
	}

	public long insertKamar(String kamar_id, String indekos_id,
			String kamar_nama, String kamar_harga, String kamar_isi,
			String kamar_ukuran_panjang, String kamar_ukuran_lebar,
			String kamar_ukuran_jenis, String kamar_foto,
			String kamar_minimal_kontrak, String kamar_minimal_kontrak_jenis,
			String kamar_kontrak_status, String kamar_kontrak_dari_tanggal,
			String kamar_kontrak_sampai_tanggal) {
		ContentValues args = new ContentValues();
		args.put(KEY_ROWID, kamar_id);
		args.put(KEY_KAMAR_ID, kamar_id);
		args.put(KEY_INDEKOS_ID, indekos_id);
		args.put(KEY_KAMAR_NAMA, kamar_nama);
		args.put(KEY_KAMAR_HARGA, kamar_harga);
		args.put(KEY_KAMAR_ISI, kamar_isi);
		args.put(KEY_KAMAR_UKURAN_PANJANG, kamar_ukuran_panjang);
		args.put(KEY_KAMAR_UKURAN_LEBAR, kamar_ukuran_lebar);
		args.put(KEY_KAMAR_UKURAN_JENIS, kamar_ukuran_jenis);
		args.put(KEY_KAMAR_FOTO, kamar_foto);
		args.put(KEY_KAMAR_MINIMAL_KONTRAK, kamar_minimal_kontrak);
		args.put(KEY_KAMAR_MINIMAL_KONTRAK_JENIS, kamar_minimal_kontrak_jenis);
		args.put(KEY_KAMAR_KONTRAK_STATUS, kamar_kontrak_status);
		args.put(KEY_KAMAR_KONTRAK_DARI_TANGGAL, kamar_kontrak_dari_tanggal);
		args.put(KEY_KAMAR_KONTRAK_SAMPAI_TANGGAL, kamar_kontrak_sampai_tanggal);
		return mDb.insert(TABEL_KAMAR, null, args);
	}

	public long insertFasilitasMaster(String fasilitas_master_id,
			String fasilitas_master_nama, String fasilitas_master_icon) {
		ContentValues args = new ContentValues();
		args.put(KEY_ROWID, fasilitas_master_id);
		args.put(KEY_FASILITAS_MASTER_ID, fasilitas_master_id);
		args.put(KEY_FASILITAS_MASTER_NAMA, fasilitas_master_nama);
		args.put(KEY_FASILITAS_MASTER_ICON, fasilitas_master_icon);
		return mDb.insert(TABEL_FASILITAS_MASTER, null, args);
	}

	public long insertFasilitasEks(String fasilitas_eks_id,
			String fasilitas_master_id, String kab_kota_id,
			String fasilitas_eks_nama, String fasilitas_eks_long,
			String fasilitas_eks_lat) {
		ContentValues args = new ContentValues();
		args.put(KEY_ROWID, fasilitas_eks_id);
		args.put(KEY_FASILITAS_EKS_ID, fasilitas_eks_id);
		args.put(KEY_FASILITAS_MASTER_ID, fasilitas_master_id);
		args.put(KEY_KAB_KOTA_ID, kab_kota_id);
		args.put(KEY_FASILITAS_EKS_NAMA, fasilitas_eks_nama);
		args.put(KEY_FASILITAS_EKS_LONG, fasilitas_eks_long);
		args.put(KEY_FASILITAS_EKS_LAT, fasilitas_eks_lat);
		return mDb.insert(TABEL_FASILITAS_EKS, null, args);
	}

	public long insertFasilitasInt(String fasilitas_int_id, String pemilik_id,
			String fasilitas_int_nama) {
		ContentValues args = new ContentValues();
		args.put(KEY_ROWID, fasilitas_int_id);
		args.put(KEY_FASILITAS_INT_ID, fasilitas_int_id);
		args.put(KEY_PEMILIK_ID, pemilik_id);
		args.put(KEY_FASILITAS_INT_NAMA, fasilitas_int_nama);
		return mDb.insert(TABEL_FASILITAS_INT, null, args);
	}

	public long insertIndekosFasilitasEks(String indekos_fasilitas_eks_id,
			String indekos_id, String fasilitas_eks_id,
			String indekos_fasilitas_eks_jarak) {
		ContentValues args = new ContentValues();
		args.put(KEY_ROWID, indekos_fasilitas_eks_id);
		args.put(KEY_INDEKOS_FASILITAS_EKS_ID, indekos_fasilitas_eks_id);
		args.put(KEY_INDEKOS_ID, indekos_id);
		args.put(KEY_FASILITAS_EKS_ID, fasilitas_eks_id);
		args.put(KEY_INDEKOS_FASILITAS_EKS_JARAK, indekos_fasilitas_eks_jarak);
		return mDb.insert(TABEL_INDEKOS_FASILITAS_EKS, null, args);
	}

	public long insertKamarFasilitasInt(String kamar_fasilitas_int_id,
			String kamar_id, String fasilitas_int_id) {
		ContentValues args = new ContentValues();
		args.put(KEY_ROWID, kamar_fasilitas_int_id);
		args.put(KEY_KAMAR_FASILITAS_INT_ID, kamar_fasilitas_int_id);
		args.put(KEY_KAMAR_ID, kamar_id);
		args.put(KEY_FASILITAS_INT_ID, fasilitas_int_id);
		return mDb.insert(TABEL_KAMAR_FASILITAS_INT, null, args);
	}

	public long insertJarakTerdekat(String indekos_id, String jarak) {
		ContentValues args = new ContentValues();
		args.put(KEY_ROWID, indekos_id);
		args.put(KEY_INDEKOS_ID, indekos_id);
		args.put(KEY_JARAK, jarak);
		return mDb.insert(TABEL_JARAK_TERDEKAT, null, args);
	}

	public Cursor get_data_kota_provinsi(Long provinsi_id) throws SQLException {
		// TODO Auto-generated method stub
		Cursor select = mDb.query(TABEL_KAB_KOTA, new String[] { KEY_ROWID,
				KEY_KAB_KOTA_ID, KEY_PROVINSI_ID, KEY_KAB_KOTA_KODE,
				KEY_KAB_KOTA_NAMA, KEY_KAB_KOTA_LONG, KEY_KAB_KOTA_LAT },
				KEY_PROVINSI_ID + "=" + provinsi_id, null, null, null,
				KEY_KAB_KOTA_NAMA);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor get_data_pemilik(Long pemilik_id) throws SQLException {
		Cursor select = mDb.query(TABEL_PEMILIK, new String[] { KEY_ROWID,
				KEY_PEMILIK_ID, KEY_PEMILIK_NO_HP }, KEY_PEMILIK_ID + "="
				+ pemilik_id, null, null, null, KEY_PEMILIK_ID);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor get_terdekat_kota(Long kab_kota_id) throws SQLException {
		Cursor select = mDb
				.rawQuery(
						"SELECT indekos._id,kamar.kamar_id,kamar.kamar_nama,kamar.kamar_kontrak_status,"
								+ " indekos.indekos_nama,indekos.indekos_id,indekos.indekos_untuk, indekos.indekos_keterangan,indekos.indekos_kab_kota_jarak, kab_kota.kab_kota_id,"
								+ " indekos.indekos_long,indekos.indekos_lat, count(kamar.kamar_id) AS jumlah "
								+ " FROM indekos,kab_kota, kamar WHERE "
								+ " indekos.kab_kota_id=kab_kota.kab_kota_id AND "
								+ " indekos.indekos_id=kamar.indekos_id AND kamar.kamar_kontrak_status='kosong' AND "
								+ " indekos.kab_kota_id="
								+ kab_kota_id
								+ " GROUP BY indekos.indekos_id ORDER BY indekos.indekos_kab_kota_jarak ASC",
						null);

		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor get_jarak_terdekat() throws SQLException {
		Cursor select = mDb
				.rawQuery(
						"SELECT jarak_terdekat._id, jarak_terdekat.indekos_id,jarak_terdekat.jarak,"
								+ "indekos.indekos_nama, indekos.indekos_untuk, indekos.indekos_keterangan "
								+ "FROM indekos, jarak_terdekat WHERE "
								+ "jarak_terdekat.indekos_id=indekos.indekos_id "
								+ "GROUP BY indekos.indekos_id ORDER BY jarak_terdekat.jarak ASC",
						null);

		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor get_fasilitas_master(Long kab_kota_id) {
		// TODO Auto-generated method stub
		Cursor select = mDb.query(TABEL_FASILITAS_MASTER, new String[] {
				KEY_ROWID, KEY_FASILITAS_MASTER_ID, KEY_FASILITAS_MASTER_ICON,
				KEY_FASILITAS_MASTER_NAMA }, null, null, null, null,
				KEY_FASILITAS_MASTER_NAMA);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor get_fasilitas_eks(Long kab_kota_id, Long fasilitas_master_id) {
		// TODO Auto-generated method stub
		Cursor select = mDb.query(TABEL_FASILITAS_EKS, new String[] {
				KEY_ROWID, KEY_FASILITAS_EKS_ID, KEY_FASILITAS_MASTER_ID,
				KEY_KAB_KOTA_ID, KEY_FASILITAS_EKS_NAMA,
				KEY_FASILITAS_EKS_LONG, KEY_FASILITAS_EKS_LAT },
				KEY_FASILITAS_MASTER_ID + "=" + fasilitas_master_id + " AND "
						+ KEY_KAB_KOTA_ID + "=" + kab_kota_id, null, null,
				null, KEY_FASILITAS_EKS_NAMA);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor get_list_indekos(Long fasilitas_eks_id) {
		// TODO Auto-generated method stub

		Cursor select = mDb
				.rawQuery(
						"SELECT indekos._id,indekos.indekos_untuk, indekos.indekos_nama,indekos.indekos_keterangan,kamar.kamar_id,kamar.kamar_nama,kamar.kamar_kontrak_status,"
								+ " indekos.indekos_long,indekos.indekos_lat, indekos_fasilitas_eks.indekos_fasilitas_eks_jarak, fasilitas_eks.fasilitas_eks_id,"
								+ " count(kamar.kamar_id) AS jumlah "
								+ " FROM indekos_fasilitas_eks, indekos,fasilitas_eks, kamar WHERE "
								+ " indekos_fasilitas_eks.indekos_id=indekos.indekos_id AND indekos_fasilitas_eks.fasilitas_eks_id=fasilitas_eks.fasilitas_eks_id AND "
								+ " indekos.indekos_id=kamar.indekos_id AND kamar.kamar_kontrak_status='kosong' AND "
								+ " indekos_fasilitas_eks.fasilitas_eks_id="
								+ fasilitas_eks_id
								+ " GROUP BY indekos_fasilitas_eks.indekos_id ORDER BY indekos_fasilitas_eks.indekos_fasilitas_eks_jarak ASC",
						null);

		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}


	public Cursor get_list_indekos_fasilitas_eks(Long fasilitas_eks_id) {
		// TODO Auto-generated method stub

		Cursor select = mDb
				.rawQuery(
						"SELECT indekos._id,indekos.indekos_untuk, indekos.indekos_nama,indekos.indekos_keterangan,"
								+ " indekos.indekos_long,indekos.indekos_lat, indekos_fasilitas_eks.indekos_fasilitas_eks_jarak, fasilitas_eks.fasilitas_eks_id"
								+ " FROM indekos_fasilitas_eks, indekos,fasilitas_eks WHERE "
								+ " indekos_fasilitas_eks.indekos_id=indekos.indekos_id AND indekos_fasilitas_eks.fasilitas_eks_id=fasilitas_eks.fasilitas_eks_id AND "
								+ " indekos_fasilitas_eks.fasilitas_eks_id="
								+ fasilitas_eks_id
								+ " GROUP BY indekos_fasilitas_eks.indekos_id ORDER BY indekos_fasilitas_eks.indekos_fasilitas_eks_jarak ASC",
						null);

		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}
	
	public boolean deleteProvinsi(String provinsi_id) {
		// TODO Auto-generated method stub
		return mDb.delete(TABEL_PROVINSI, KEY_PROVINSI_ID + "=" + provinsi_id,
				null) > 0;
	}

	public boolean deletePemilik(String pemilik_id) {
		return mDb.delete(TABEL_PEMILIK, KEY_PEMILIK_ID + "=" + pemilik_id,
				null) > 0;
	}

	public boolean deleteKabkota(String kab_kota_id) {
		// TODO Auto-generated method stub
		return mDb.delete(TABEL_KAB_KOTA, KEY_KAB_KOTA_ID + "=" + kab_kota_id,
				null) > 0;
	}

	public boolean deleteIndekos(String indekos_id) {
		return mDb.delete(TABEL_INDEKOS, KEY_INDEKOS_ID + "=" + indekos_id,
				null) > 0;
	}

	public boolean deleteKamar(String kamar_id) {
		return mDb.delete(TABEL_KAMAR, KEY_KAMAR_ID + "=" + kamar_id, null) > 0;
	}

	public boolean deleteFasilitasMaster(String fasilitas_master_id) {
		return mDb.delete(TABEL_FASILITAS_MASTER, KEY_FASILITAS_MASTER_ID + "="
				+ fasilitas_master_id, null) > 0;
	}

	public boolean deleteFasilitasEks(String fasilitas_eks_id) {
		return mDb.delete(TABEL_FASILITAS_EKS, KEY_FASILITAS_EKS_ID + "="
				+ fasilitas_eks_id, null) > 0;
	}

	public boolean deleteFasilitasInt(String fasilitas_int_id) {
		return mDb.delete(TABEL_FASILITAS_INT, KEY_FASILITAS_INT_ID + "="
				+ fasilitas_int_id, null) > 0;
	}

	public boolean deleteIndekosFasilitasEks(String indekos_fasilitas_eks_id) {
		return mDb.delete(TABEL_INDEKOS_FASILITAS_EKS,
				KEY_INDEKOS_FASILITAS_EKS_ID + "=" + indekos_fasilitas_eks_id,
				null) > 0;
	}

	public boolean deleteKamarFasilitasInt(String kamar_fasilitas_int_id) {
		return mDb.delete(TABEL_KAMAR_FASILITAS_INT, KEY_KAMAR_FASILITAS_INT_ID
				+ "=" + kamar_fasilitas_int_id, null) > 0;
	}

	public boolean deleteJarakTerdekat(String indekos_id) {
		return mDb.delete(TABEL_JARAK_TERDEKAT, KEY_INDEKOS_ID + "="
				+ indekos_id, null) > 0;
	}

	public Cursor select_provinsi(String provinsi_id) {
		// TODO Auto-generated method stub
		return mDb.query(TABEL_PROVINSI, new String[] { KEY_ROWID,
				KEY_PROVINSI_ID, KEY_PROVINSI_KODE, KEY_PROVINSI_NAMA },
				KEY_PROVINSI_ID + "=" + provinsi_id, null, null, null,
				KEY_PROVINSI_NAMA);
	}

	public Cursor select_pemilik(String pemilik_id) {
		return mDb.query(TABEL_PEMILIK, new String[] { KEY_ROWID,
				KEY_PEMILIK_ID, KEY_PEMILIK_NO_HP }, KEY_PEMILIK_ID + "="
				+ pemilik_id, null, null, null, KEY_PEMILIK_ID);
	}

	public Cursor select_kab_kota(String kab_kota_id) {
		// TODO Auto-generated method stub
		return mDb.query(TABEL_KAB_KOTA, new String[] { KEY_ROWID,
				KEY_KAB_KOTA_ID, KEY_PROVINSI_ID, KEY_KAB_KOTA_KODE,
				KEY_KAB_KOTA_NAMA, KEY_KAB_KOTA_LONG, KEY_KAB_KOTA_LAT },
				KEY_KAB_KOTA_ID + "=" + kab_kota_id, null, null, null,
				KEY_KAB_KOTA_NAMA);
	}

	public Cursor select_indekos(String indekos_id) {
		return mDb.query(TABEL_INDEKOS,
				new String[] { KEY_ROWID, KEY_INDEKOS_ID, KEY_PEMILIK_ID,
						KEY_KAB_KOTA_ID, KEY_INDEKOS_NAMA, KEY_INDEKOS_UNTUK,
						KEY_INDEKOS_KETERANGAN, KEY_INDEKOS_LONG,
						KEY_INDEKOS_LAT, KEY_INDEKOS_KAB_KOTA_JARAK },
				KEY_INDEKOS_ID + "=" + indekos_id, null, null, null,
				KEY_INDEKOS_NAMA);
	}

	public Cursor select_kamar(String kamar_id) {
		return mDb.query(TABEL_KAMAR, new String[] { KEY_ROWID, KEY_KAMAR_ID,
				KEY_INDEKOS_ID, KEY_KAMAR_NAMA, KEY_KAMAR_HARGA, KEY_KAMAR_ISI,
				KEY_KAMAR_UKURAN_PANJANG, KEY_KAMAR_UKURAN_LEBAR,
				KEY_KAMAR_UKURAN_JENIS, KEY_KAMAR_FOTO,
				KEY_KAMAR_MINIMAL_KONTRAK, KEY_KAMAR_MINIMAL_KONTRAK_JENIS,
				KEY_KAMAR_KONTRAK_STATUS, KEY_KAMAR_KONTRAK_DARI_TANGGAL,
				KEY_KAMAR_KONTRAK_SAMPAI_TANGGAL }, KEY_KAMAR_ID + "="
				+ kamar_id, null, null, null, KEY_KAMAR_NAMA);
	}

	public Cursor select_fasilitas_master(String fasilitas_master_id) {
		return mDb.query(TABEL_FASILITAS_MASTER, new String[] { KEY_ROWID,
				KEY_FASILITAS_MASTER_ID, KEY_FASILITAS_MASTER_NAMA,
				KEY_FASILITAS_MASTER_ICON }, KEY_FASILITAS_MASTER_ID + "="
				+ fasilitas_master_id, null, null, null,
				KEY_FASILITAS_MASTER_NAMA);
	}

	public Cursor select_fasilitas_eks(String fasilitas_eks_id) {
		return mDb.query(TABEL_FASILITAS_EKS, new String[] { KEY_ROWID,
				KEY_FASILITAS_EKS_ID, KEY_FASILITAS_MASTER_ID, KEY_KAB_KOTA_ID,
				KEY_FASILITAS_EKS_NAMA, KEY_FASILITAS_EKS_LONG,
				KEY_FASILITAS_EKS_LAT }, KEY_FASILITAS_EKS_ID + "="
				+ fasilitas_eks_id, null, null, null, KEY_FASILITAS_EKS_NAMA);
	}

	public Cursor select_fasilitas_int(String fasilitas_int_id) {
		return mDb.query(TABEL_FASILITAS_INT, new String[] { KEY_ROWID,
				KEY_FASILITAS_INT_ID, KEY_PEMILIK_ID, KEY_FASILITAS_INT_NAMA },
				KEY_FASILITAS_INT_ID + "=" + fasilitas_int_id, null, null,
				null, KEY_FASILITAS_INT_NAMA);
	}

	public Cursor select_indekos_fasilitas_eks(String indekos_fasilitas_eks_id) {
		return mDb.query(TABEL_INDEKOS_FASILITAS_EKS, new String[] { KEY_ROWID,
				KEY_INDEKOS_FASILITAS_EKS_ID, KEY_INDEKOS_ID,
				KEY_FASILITAS_EKS_ID, KEY_INDEKOS_FASILITAS_EKS_JARAK },
				KEY_INDEKOS_FASILITAS_EKS_ID + "=" + indekos_fasilitas_eks_id,
				null, null, null, KEY_INDEKOS_FASILITAS_EKS_ID);
	}

	public Cursor select_kamar_fasilitas_int(String kamar_fasilitas_int_id) {
		return mDb.query(TABEL_KAMAR_FASILITAS_INT,
				new String[] { KEY_ROWID, KEY_KAMAR_FASILITAS_INT_ID,
						KEY_KAMAR_ID, KEY_FASILITAS_INT_ID },
				KEY_KAMAR_FASILITAS_INT_ID + "=" + kamar_fasilitas_int_id,
				null, null, null, KEY_KAMAR_FASILITAS_INT_ID);
	}

	public Cursor get_list_kamar(Long indekos_id) {
		// TODO Auto-generated method stub
		Cursor select = mDb
				.rawQuery(
						"SELECT kamar._id,indekos.indekos_id,indekos.indekos_nama,indekos.indekos_untuk,"
								+ "pemilik.pemilik_id,pemilik.pemilik_no_hp,indekos.indekos_keterangan,kamar.kamar_nama, kamar.kamar_isi,kamar.kamar_harga,"
								+ "indekos.pemilik_id,indekos.indekos_long, indekos.indekos_lat, kamar.kamar_id,kamar.kamar_ukuran_panjang,"
								+ "kamar.kamar_ukuran_lebar, kamar.kamar_ukuran_jenis, kamar.kamar_foto,"
								+ "kamar.kamar_minimal_kontrak, kamar.kamar_minimal_kontrak_jenis,kamar.indekos_id,"
								+ "kamar.kamar_kontrak_status FROM kamar,indekos,pemilik WHERE "
								+ "kamar.indekos_id=indekos.indekos_id AND kamar.indekos_id="
								+ indekos_id
								+ " AND pemilik.pemilik_id=indekos.pemilik_id ORDER BY kamar.kamar_nama ASC",
						null);
		/*Cursor select = mDb
				.rawQuery(
						"SELECT kamar._id,indekos.indekos_id,indekos.indekos_nama,indekos.indekos_untuk,"
								+ "pemilik.pemilik_id,pemilik.pemilik_no_hp,indekos.indekos_keterangan,kamar.kamar_nama, kamar.kamar_isi,kamar.kamar_harga,"
								+ "indekos.pemilik_id,indekos.indekos_long, indekos.indekos_lat, kamar.kamar_id,kamar.kamar_ukuran_panjang,"
								+ "kamar.kamar_ukuran_lebar, kamar.kamar_ukuran_jenis, kamar.kamar_foto,"
								+ "kamar.kamar_minimal_kontrak, kamar.kamar_minimal_kontrak_jenis,kamar.indekos_id,"
								+ "kamar.kamar_kontrak_status FROM kamar,indekos,pemilik WHERE "
								+ "kamar.indekos_id=indekos.indekos_id AND kamar.indekos_id="
								+ indekos_id
								+ " AND kamar.kamar_kontrak_status='kosong' AND pemilik.pemilik_id=indekos.pemilik_id ORDER BY kamar.kamar_nama ASC",
						null);*/
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor get_detail_indekos(Long indekos_id) {
		// TODO Auto-generated method stub
		Cursor select = mDb.rawQuery("SELECT * FROM indekos,pemilik WHERE indekos.pemilik_id=pemilik.pemilik_id AND indekos.indekos_id="
				+ indekos_id, null);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor get_detail_indekos_terdekat_kota(Long kab_kota_id) {
		// TODO Auto-generated method stub
		Cursor select = mDb.rawQuery("SELECT * FROM indekos WHERE kab_kota_id="
				+ kab_kota_id+" ORDER BY indekos_kab_kota_jarak ASC", null);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor get_detail_kamar(Long kamar_id) {
		// TODO Auto-generated method stub
		Cursor select = mDb
				.rawQuery(
						"SELECT * FROM kamar, fasilitas_int, kamar_fasilitas_int WHERE "
								+ "kamar_fasilitas_int.kamar_id=kamar.kamar_id AND kamar_fasilitas_int.fasilitas_int_id=fasilitas_int.fasilitas_int_id AND"
								+ " kamar.kamar_id=" + kamar_id
								+ " AND kamar.kamar_kontrak_status='kosong'",
						null);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

	public Cursor detail_kamar(Long kamar_id) {
		Cursor select = mDb.rawQuery("SELECT * FROM kamar WHERE kamar_id="
				+ kamar_id, null);
		if (select != null) {
			select.moveToFirst();
		}
		return select;
	}

}
