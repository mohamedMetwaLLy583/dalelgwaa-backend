<?php

namespace App\Repositories\ContactUs;

use Exception;
use App\Models\ContactUs;
use App\Mail\ContactUsEmail;
use App\Contracts\CrudRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\ContactUs\ContactUsResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Mail\ContactUsMail;

class ContactUsRepository implements CrudRepository
{

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function all()
    {
        return ContactUsResource::collection(ContactUs::orderBy('id', 'DESC')->paginate());
    }

    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(array $data)
    {
        try {
            DB::beginTransaction();

            $contact = ContactUs::create([
                'name'    => $data['name'],
                'email'   => $data['email'],
                'message' => $data['message'],
            ]);
            
            DB::commit();
            Mail::to(config('mail.from.address'))->send(new ContactUsMail($contact));

            return response()->json(['status' => true, 'message' => __('response.created')]);
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);

            return response()->json(['error' => __('response.server_error')], 500);
        }
    }

    /**
     * @param mixed $model
     * @return Model|void
     */
    public function find($model)
    {
        try {
            if ($model instanceof ContactUs) {
                return $model;
            }

            return ContactUs::findOrFail($model);
        } catch (\Throwable $th) {
            throw new HttpResponseException(response()->json(['error' => 'Not Found'], 404));
        }
    }

    /**
     * @param mixed $model
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        return response()->json(['message' => 'Not found'], 404);
    }

    /**
     * @param mixed $model
     * @throws Exception
     */
    public function delete($model)
    {
        $contact_us = $this->find($model);
        try {
            $contact_us->delete();

            return  response()->json(['message' => __('response.deleted')]);
        } catch (\Throwable $th) {
            report($th);

            return  response()->json(['error' => __('response.server_error')], 500);
        }
    }
}
