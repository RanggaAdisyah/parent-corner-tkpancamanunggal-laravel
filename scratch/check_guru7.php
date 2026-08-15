$g = \App\Models\Guru::withTrashed()->where("user_id", 7)->first();
echo $g ? "Guru found: " . $g->nama_lengkap . " (id=" . $g->id . ")" : "No guru with user_id=7";
echo PHP_EOL;
