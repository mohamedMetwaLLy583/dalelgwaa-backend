<?php

namespace App\Repositories\Admin;

use Exception;
use App\Models\User;
use App\Contracts\CrudRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\Admin\AdminResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AdminRepository implements CrudRepository
{

    /**
     * @return AdminResource
     */
    public function all()
    {
        return new AdminResource(User::first());
    }

    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(array $data)
    {
        return response()->json(['message' => 'Not found'], 404);
    }

    /**
     * @param mixed $model
     * @return \Illuminate\Http\JsonResponse
     */
    public function find($model)
    {
        return response()->json(['message' => 'Not found'], 404);
    }

    /**
     * @param mixed $model
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($contact_id, array $data)
    {
        try {
            DB::beginTransaction();

            $contact = User::first();
            $contact->update([
                'address:ar' => $data['address_ar'] ?? null,
                'address:en' => $data['address_en'] ?? null,
                'phone'      => $data['phone']      ?? null,
                'email'      => $data['email']      ?? null,
                'whatsapp'   => $data['whatsapp']   ?? null,
                'facebook'   => $data['facebook']   ?? null,
                'instagram'  => $data['instagram']  ?? null,
                'x'          => $data['x']          ?? null,
                'linkedin'   => $data['linkedin']   ?? null,
            ]);

            DB::commit();
            return response()->json(['status' => true, 'message' => __('response.updated')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * @param mixed $model
     * @throws Exception
     */
    public function delete($model)
    {
        return response()->json(['message' => 'Not found'], 404);
    }
}
