<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\rule;
use App\Models\Variable;
use App\Models\Criteria;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function index()
    {
        if(request()->user()->hasrole('admin'))
    {
            return view('admin.dashboard');
        }
        else
        {
            return redirect('login');
        }
        
    }

    public function datauser(Request $request) {
        $data_user = User::all();
        
        return view('admin.datauser', ['users' => $data_user]);
    }

    public function formuser(){
        $data_role = Role::all();
        return view('admin.form_user', ['roles' => $data_role]);
    }

    public function createuser(Request $request) {
        $data_user = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
            
        ];
        $save_user = User::create($data_user);

        $data_role = [
            "user_id" => $save_user->id,
            "role_id" => $request->role
        ];
        UserRole::create($data_role);
        $request->session()->flash('sukses', 'Data User Berhasil Ditambahkan');
        return redirect('/admin/datauser');
    }

    public function edituser($id) {
        $data_user = User::find($id);
        return view('admin/edit', ['user' => $data_user]);
    }

    public function updateuser(Request $request, $id){
        $data_user = User::find($id);
        $data_user -> update($request->all());
        $request->session()->flash('editsukses', 'Data User Berhasil Diubah');
        return redirect('/admin/datauser');
    }

    public function deleteuser(Request $request, $id){
        $data_user = User::find($id);
        $data_user -> delete();
        $request->session()->flash('hapus', 'Data User Berhasil Dihapus');
        return redirect('/admin/datauser');
    }


    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function datacandidate(Request $request) {
        $data_candidate = Post::all();
        
        return view('admin.data', ['candidates' => $data_candidate]);
    }

    public function form(){
        return view('admin.form');
    }

    public function createcandidate(Request $request) {
        $data_candidate = [
            "nama" => $request->nama,
            "penghasilan" => $request->penghasilan,
            "jumlah_tanggungan" => $request->tanggungan,
            "daya_listrik" => $request->daya_listrik

        ];
        $save_user = Post::create($data_candidate);
        $request->session()->flash('sukses', 'Data Calon Berhasil Ditambahkan');
        return redirect('/admin/datacalon');
    }

    public function edit($id) {
        $data_candidate = Post::find($id);
        return view('admin.edit', ['candidates' => $data_candidate]);
    }

    public function update(Request $request, $id){
        $data_candidate = Post::find($id);
        $data_candidate -> update($request->all());
        $request->session()->flash('editsukses', 'Data Calon Berhasil Diubah');
        return redirect('/admin/datacalon');
    }

    public function delete(Request $request, $id){
        $data_candidate = Post::find($id);
        $data_candidate -> delete();
        $request->session()->flash('hapus', 'Data Calon Berhasil Dihapus');
        return redirect('/admin/datacalon');
    }


    public function variable()
    {
        $data_criteria = Variable::all();
        return view('admin.kriteria', ['criterias' => $data_criteria]);
    }

    public function formvariable(){
        return view ('admin.form_kriteria');
    }

    public function createvariable(Request $request) {
        $data_variabel = [
            "name" => $request->name,
            "nilai1" => $request->nilai_1,
            "nilai11" => $request->nilai_11,
            "nilai2" => $request->nilai_2,
            "nilai22" => $request->nilai_22,
            "nilai3" => $request->nilai_3,
            "nilai33" => $request->nilai_33,
            "ket1" => $request->ket_1,
            "ket2" => $request->ket_2,
            "ket3" => $request->ket_3
            

        ];
        $save_user = Criteria::create($data_variabel);
        $request->session()->flash('sukses', 'Data Kriteria Berhasil Ditambahkan');
        return redirect('/admin/variable');
    }

    public function rules()
    {
        $data_rule = rule::all();
        return view('admin.rules', ['rules' => $data_rule]);
    }

    public function ruleform(){
        return view('admin.ruleform');
    }

    public function createrule(Request $request) {
        $data_rule = [
            "rule" => $request->rule,
            "k1" => $request->kriteria_1,
            "k2" => $request->kriteria_2,
            "k3" => $request->kriteria_3,
            "then" => $request->then

        ];
        $save_user = rule::create($data_rule);
        $request->session()->flash('sukses', 'Data Rule Berhasil Ditambahkan');
        return redirect('/admin/rule');
    }

    public function editrule($id) {
        $data_rule = rule::find($id);
        return view('admin.editrule', ['rules' => $data_rule]);
    }

    public function updaterule(Request $request, $id){
        $data_rule = rule::find($id);
        $data_rule -> update($request->all());
        $request->session()->flash('editsukses', 'Data Rule Berhasil Diubah');
        return redirect('/admin/rule');
    }

    public function deleterule(Request $request, $id){
        $data_rule = rule::find($id);
        $data_rule -> delete();
        $request->session()->flash('hapus', 'Data Rule Berhasil Dihapus');
        return redirect('/admin/rule');
    }

    public function fuzzi()
    {
        $variables = ['Tanggungan', 'Penghasilan', 'Daya Listrik'];
        $outputs = ['Subsidi', 'Non Subsidi'];
        
        $input = [
            'tanggungan' => 1,
            'penghasilan' => 2500000,
            'luasBangunan' => 900
        ];

        // fungsi untuk ambil data keanggotaan "Tanggungan"
        $lowerTanggungan = $this->lowFunction($input['tanggungan'], 1, 3);
        $mediumTanggungan = $this->mediumFunction($input['tanggungan'], 1, 3, 6);
        $highTanggungan = $this->highFunction($input['tanggungan'], 3, 6);

        // fungsi untuk ambil data keanggotaan "Penghasilan"
        $lowerFee = $this->lowFunction($input['penghasilan'], 1000000, 3000000);
        $mediumFee = $this->mediumFunction($input['penghasilan'], 1000000, 3000000, 5000000);
        $highFee = $this->highFunction($input['penghasilan'], 3000000, 5000000);

        // fungsi untuk ambil data keanggotaan "Luas Bangunan"
        $lowerBuild = $this->lowFunction($input['luasBangunan'], 450, 900);
        $mediumBuild = $this->mediumFunction($input['luasBangunan'], 450, 900, 1300);
        $highBuild = $this->highFunction($input['luasBangunan'], 900, 1300);

        $tanggungan = [
            'rendah' => $lowerTanggungan,
            'sedang' => $mediumTanggungan,
            'tinggi' => $highTanggungan
        ];

        $penghasilan = [
            'rendah' => $lowerFee,
            'sedang' => $mediumFee,
            'tinggi' => $highFee
        ];

        $luasBangunan = [
            'rendah' => $lowerBuild,
            'sedang' => $mediumBuild,
            'tinggi' => $highBuild
        ];

        // Untuk tampilkan data
        return ['tanggungan' => $tanggungan, 'penghasilan' => $penghasilan, 'luas bangunan' => $luasBangunan];
    }

    public function lowFunction($input, $start, $range) {
        $value = 0;
        if ($input >= $range) {
            $value = 0;
        } else if ($input > $start && $input < $range) {
            $value = ($range - $input) / ($range - $start);
        } else if ($input <= $start) {
            $value = 1;
        }

        return $value;
    }

    public function mediumFunction($input, $start, $range, $end) {
        $value = 0;
        if ($input <= $start || $input >= $end) {
            $value = 0;
        } else if ($input >= $range && $input <= $end) {
            $value = ($end - $input) / ($end - $range);
        } else if ($input >= 1 && $input <= $range) {
            $value = ($input - $start) / ($range - $start);
        }

        return $value;
    }

    public function highFunction($input, $range, $end) {
        $value = 0;
        if ($input <= $range) {
            $value = 0;
        } else if ($input > $range && $input <= $end) {
            $value = ($input - $range) / ($end - $range);
        } else if ($input >= $end) {
            $value = 1;
        }

        return $value;
    }
}
