<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Client;
use App\Helpers\Helper;
use App\Mail\ClientMail;
use Illuminate\Http\Request;
use App\Services\ClientService;
use App\Mail\ForgotPasswordMail;
use App\Mail\RegisterSuccessMail;
use App\Models\ForgotPasswordCode;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Mail;
use App\Exceptions\NoPlanFoundException;
use App\Exceptions\AlreadyCheckInException;
use App\Exceptions\ClientNotFoundException;
use App\Exceptions\AlreadyCheckOutException;
use App\Http\Requests\Auth\ClientCheckRequest;
use App\Exceptions\PlanHasExpiredException;

class ClientController extends Controller
{
    public function show_check_in_form() {
        return view('client.check-in');
    }

    public function check_in_process(ClientCheckRequest $request) {
        try {
            $clientPlan = (new ClientService())->check_in($request->all());
        } catch (ClientNotFoundException $exception) {
            return redirect()->back()->with('error', 'Username/Password is wrong');
        } catch (AlreadyCheckInException $exception) {
            return redirect()->back()->with('error', 'Already check in');
        } catch (NoPlanFoundException $exception) {
            return redirect()->back()->with('error', 'Please top up at the counter');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        return redirect()->back()->with('success', [
            'message' => 'Check in success',
            'remaining_time' => $clientPlan['remaining_time'],
            'expiration' => $clientPlan['expiration'],
        ]);
    }

    public function show_check_out_form() {
        return view('client.check-out');
    }

    public function check_out_process(ClientCheckRequest $request) {
        try {
            (new ClientService())->check_out($request->all());
        } catch (ClientNotFoundException $exception) {
            return redirect()->back()->with('error', 'Username/Password is wrong');
        } catch (AlreadyCheckOutException $exception) {
            return redirect()->back()->with('error', 'Already check in');
        } catch (NoPlanFoundException $exception) {
            return redirect()->back()->with('error', 'Please top up at the counter');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        return redirect()->back()->with('success', 'Check out success');
    }

    public function sign_up_store(ClientRequest $request) {
        $client = Client::create($request->all());

        if($client) {

            Mail::to($client->email)->send(new RegisterSuccessMail($client));
            return redirect()->back()->with('success', 'Sign up successfully');
        }

        return redirect()->back()->with('error', 'Sign up failed');
    }

    public function show_send_code_form() {
        return view('client.forgot_password.send-code');
    }

    public function send_code_process(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $client = Client::where('email', '=', $validated['email'])->first();

        // dd($client->id);
        if($client) {
            $code = Helper::generateCode();

            $oldCode = ForgotPasswordCode::where('client_id', $client->id)->where('is_expired', 'false')->first();

            if($oldCode) {
                $oldCode->is_expired = true;
                $oldCode->save();
            }

            $forgotPassword = ForgotPasswordCode::create([
                'client_id' => $client->id,
                'code' => $code,
            ]);

            if($forgotPassword) {
                Mail::to($client->email)->send(new ForgotPasswordMail($code));
                return view('client.forgot_password.verify-code', [
                    'clientId' => $client->id,
                    'forgotPassword' => $forgotPassword->id,
                ]);
            } else {
                return redirect()->back()->with('error', 'No account is linked to your email address');
            }
        } else {
            return redirect()->back()->with('error', 'No account is linked to your email address');
        }
    }

    public function verify_code_process($id, Request $request) {
        $validated = $request->validate([
            'code' => 'required|min:6',
        ]);

        $client = Client::find($id);

        if($client) {
            $forgotPassword = ForgotPasswordCode::check($client->id, $validated['code'])->get();

            if($forgotPassword->count() > 0) {
                $forgotPassword->is_expired = true;
                return redirect()->route('forgot_password.show_reset_password',['id' => $client->id]);
                return view('client.forgot_password.reset-password', compact('client'));
            } else {
                return redirect()->route('client.show_check_in_form')->with('error', 'Code Expired');
            }
        } else {
            return redirect()->route('client.show_send_code_form');
        }
    }

    public function show_reset_password_form($id) {
        $client = Client::find($id);
        return view('client.forgot_password.reset-password', compact('client'));
    }

    public function reset_password_process($id, Request $request) {
        $validated = $request->validate([
            'password' => 'required|min:8',
            'password_confirmation' => 'same:password',
        ]);

        $client = Client::find($id);

        if($client) {
            $client->password = $request->password;
            if($client->save()) {
                return redirect()->route('client.show_check_in_form')->with('success', 'Password update successfully');
            } else {
                return redirect()->route('client.show_check_in_form')->with('error', 'Password update failed');
            }
        } else {
            return redirect()->route('forgot_password.show_send_code_form')->with('error', 'No account is linked to your email address');
        }
    }
}
