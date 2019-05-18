<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\PegawaiTransformers;
use App\Pegawai;
use App\Exceptions\InvalidCredentialException;
use Validator;

class PegawaiController extends RestController
{
    protected $transformer=PegawaiTransformers::Class;

    public function index()
    {
        $pegawai=Pegawai::get();
        $response=$this->generateCollection($pegawai);
        return $this->sendResponse($response,201);
    }

    public function showMontir()
    {
        dd('tes');
        $pegawai = Pegawai::where('Id_Role','4')->get();
        $response=$this->generateCollection($pegawai);
        return $this->sendResponse($response,201);
    }

    public function store(Request $request)
    {
        $pegawai = Pegawai::create([
            'Id_Role'           => $request->Id_Role,
            'Id_Cabang'         => $request->Id_Cabang,
            'Nama_Pegawai'      => $request->Nama_Pegawai,
            'Alamat_Pegawai'    => $request->Alamat_Pegawai,
            'Telepon_Pegawai'   => $request->Telepon_Pegawai,
            'Gaji_Pegawai'      => $request->Gaji_Pegawai,
            'Username'          => $request->Username,
            'Password'          => bcrypt($request->Password),
        ]);
       
        return response()->json([
            'status' => (bool) $pegawai,
            'data' => $pegawai,
            'message' => $pegawai ? 'Success' : 'Error Pegawai'
        ]);
    }

    public function update(Request $request, $id)
    {   
        $pegawai = Pegawai::find($id);

        if(!is_null($request->Nama_Pegawai)){
            $pegawai->Nama_Pegawai = $request->Nama_Pegawai;
        }
        if(!is_null($request->Alamat_Pegawai)){
            $pegawai->Alamat_Pegawai = $request->Alamat_Pegawai;
        }
        if(!is_null($request->Telepon_Pegawai)){
            $pegawai->Telepon_Pegawai = $request->Telepon_Pegawai;
        }
        if(!is_null($request->Gaji_Pegawai)){
            $pegawai->Gaji_Pegawai = $request->Gaji_Pegawai;
        }
        if(!is_null($request->Username)){
            $pegawai->Username = $request->Username;
        }
        if(!is_null($request->Id_Role)){
            $pegawai->Id_Role = $request->Id_Role;
        }
        if(!is_null($request->Id_Cabang)){
            $pegawai->Id_Cabang = $request->Id_Cabang;
        }
        $success = $pegawai->save();
        if(!$success){
            return response()->json('Error Update',500);
        }else   
            return response()->json('Success',200);
    }


    public function showbyID($id)
    {
        $pegawai = Pegawai::find($id);
        return response()->json($pegawai,200);
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        $status = $pegawai->delete();
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Deleted' : 'Error Delete'
        ]);
    }
    
    public function validateUser($username,$password)
    {
        try{
            $user = Pegawai::where('Username',$username)->firstOrFail();
            
            if (!password_verify($password, $user->Password)) {
                dd('i am here');
                throw new InvalidCredentialException();
            }

            return $user;
        } catch(ModelNotFoundException $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    public function mobileauthenticate(Request $request)
    {
        try {
            $user = $this->validateUser($request->get('Username'), $request->get('Password'));
            
            $response = $this->generateItem($user,PegawaiTransformers::class);

            return $this->sendResponse($response, 201);

        } catch (InvalidCredentialExcpetion $e) {
            return $this->sendNotAuthorizeResponse($e->getMessage());
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
