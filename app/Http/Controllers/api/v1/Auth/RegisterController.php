<?php

namespace App\Http\Controllers\api\v1\Auth;

use App\Events\UserRegistered;
use App\Exceptions\UserHasBeenTakenException;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\vi\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        $data = $request->validated();

        if (User::query()->WhereEmail($data['email'])->exists()) {
            throw new UserHasBeenTakenException;
        }

        $user = User::query()->create($data);

        $teamName = explode(' ', $data['name'])[0]."'s Team";
        $team = Team::query()->create([
            'token' => Str::uuid(),
            'name' => $teamName,
        ]);

        setPermissionsTeamId($team->id);
        $user->assignRole('admin');

        $user = new UserResource($user);
        $user->default_team_id = $team->id;
        $user->save();

        UserRegistered::dispatch($user);

        return response()->json($user, 200);
    }
}
