<?php

namespace App\Http\Controllers;

use App\Models\ShopeeModel;
use Illuminate\Http\Request;

class ShopeeController extends Controller
{
    public function index()
    {
        $dataAPI = $this->getDataAPI();
        return view("index", compact('dataAPI'));
    }

    public function store(Request $request)
    { 
        $input = $request->all();
        $shopeeModel = new ShopeeModel();
        $shopeeModel->data = json_encode(explode(",", $input['pass-data']));
        $shopeeModel->count = count(explode(",", $input['pass-data']));
        $shopeeModel->save();
        $dataAPI = $this->getDataAPI();
        return view("index", compact('dataAPI'));
    }

    public function exec()
    {
        $data = ShopeeModel::find(ShopeeModel::max('id'));
        $array = json_decode($data->data, true);
        foreach($array as $item){
            $this->saveVoucherToUserWhenCallAPI($item);
        }
    }

    public function saveVoucherToUserWhenCallAPI($value)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => env('URL_SAVE_VOUCHER'),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{"voucher_code":' . $value.',"need_user_voucher_status":true}',
          CURLOPT_HTTPHEADER => array(
            'Cookie: __LOCALE__null=VN; csrftoken=CsSMWZwLhzagSI455a6b7ZpA59KW0wIJ; REC_T_ID=77f736e0-2c57-11ed-8fcc-065d2e61392e; SPC_F=bdo3fu9CEb4U1B08fOegv955HzA6xAmg; REC_T_ID=77f983ca-2c57-11ed-a32c-aafca1705890; _QPWSDCXHZQA=547d509b-ce4c-4b5c-9188-46519c52939e; G_ENABLED_IDPS=google; G_AUTHUSER_H=0; SPC_CLIENTID=YmRvM2Z1OUNFYjRVmfqfxvkdmlbixcga; _hjSessionUser_868286=eyJpZCI6ImI4ZTY1NTk1LTc5ZjItNTE2NC04NzkyLTAwMGZiNzk5YjkxMyIsImNyZWF0ZWQiOjE2NjIyOTg5NzQwMjMsImV4aXN0aW5nIjp0cnVlfQ==; django_language=vi; _ga_CGXK257VSB=GS1.1.1666432640.2.0.1666432642.58.0.0; SPC_T_ID="WTc+lS9RXKD8urwA+SQ75xSDL2MqiXP/n+q8RkVgTzGeo2bXLX/xXvbHHLYwXM8DNlKRmhvvyIIoiamAP8LvC36EPRdYH6Sa7wIoMcJWBoc="; SPC_T_IV="IhanK2ibj58X6nP4vx7ZtA=="; SPC_IA=1; cto_bundle=pc-Iq193N09IUXlRTXhheXl2UVFyeXk1dTVNTWRLT2E2TjB0YmtNdjRjYUFYT2I0dXF6aCUyQk9Jdnh5QWVpNXM1aEdQM0QwU21reVd6MkJxaXdrJTJGQTNzM3lxUGVDVWNZNkZ1bE1vWmFIMHdleGdFa3ZwbXpzJTJCMG9rY2h2MVNDaENId2VvZnNrdUMxR2VpUSUyRjNER1d6SVUlMkZZbUd3JTNEJTNE; _gcl_au=1.1.1185300506.1672587953; next-i18next=en; _fbp=fb.1.1678357108588.299082170; SPC_SI=HjoQZAAAAABQNHRtY0pFUeIBEAAAAAAAMTNacXkxOFA=; _gid=GA1.2.1925574497.1678886915; SPC_ST=.OHI3Q0QzdDFnMzZJZHl2RorijnHH+9AlqQobhkqAnzif6oQwtrYU6ue21xrKXcYrF5JOExHMnrr0gR32Y+bEtlNJmz/IHwcL7el8yEfLyzK05K9juq8syKL5Mcde5PE+4xY83Pnc7aSoh032ASHYNhZjiH1Oieh4I7Rxx2slFmHjxHner3aFuVl6wZbcQ0a/XjleJI6a3yTdhQ9FjCWrBw==; SPC_U=32022632; SPC_R_T_ID=LbgjMnAMf3tKQ70yQfUlLTzeKsLRRd4NmjBseI3h7SxEaEJ7Kr2ubCB9NY2TmIYCJONmC7BHDiWGRvGz6yQubWBnqMIvn6+1ufOz4AgQOFX6XrtMve6FNpxnB4iJitU0ylcN84tozAbTuv224QoGab/ja9fe6tz3Sh5/qXfsdsg=; SPC_R_T_IV=SGtHRlJ1Y0FWYUVrWERwbg==; SPC_T_ID=LbgjMnAMf3tKQ70yQfUlLTzeKsLRRd4NmjBseI3h7SxEaEJ7Kr2ubCB9NY2TmIYCJONmC7BHDiWGRvGz6yQubWBnqMIvn6+1ufOz4AgQOFX6XrtMve6FNpxnB4iJitU0ylcN84tozAbTuv224QoGab/ja9fe6tz3Sh5/qXfsdsg=; SPC_T_IV=SGtHRlJ1Y0FWYUVrWERwbg==; _med=refer; _hjIncludedInSessionSample_868286=0; _hjSession_868286=eyJpZCI6ImNjZDQ2MTMwLTkyMzgtNDA4YS1iNzM5LTEyMDljM2M3NDQ5YSIsImNyZWF0ZWQiOjE2Nzg4OTY1MzMxNTEsImluU2FtcGxlIjpmYWxzZX0=; AMP_TOKEN=%24NOT_FOUND; _ga=GA1.2.1055146399.1662298973; _dc_gtm_UA-61914164-6=1; ds=eb04e5218892f7eb1277b74aca4a1efb; shopee_webUnique_ccd=ujipmRUq%2FIAecBryomMO6g%3D%3D%7CqDYvVi9pNsR0dIwng9pr2T%2FupmMABGh9PuN5UgtPpnghG3WKP8QyuZaubyW9lPhOYy5HGgIW%2Fxdbv3tvQVieZKkgOodQ7ViXmVck%7COYUt8bkjzmMJB1BH%7C06%7C3; _ga_M32T05RVZT=GS1.1.1678896533.43.1.1678896544.49.0.0; SPC_EC=WlpDQVhhMDZNNnZTWWVEbDQRfsLQ3LtQoDSQ/qvvZ/ioDaPGKQGiAddBHslHOMexb3DNPZKPzphYA47gESm2h5JN5An0QuDW1Q4iq5MSUfJjoB+7H02cMxp/3fyllKXzL+UkPtkkX7xo4Kpj+Gq+Kkj6dLPXWARf1k+yZQZFWaU=; SPC_EC=Q2F1UGdpaXFrVVpSdkxlWZ6UvOtqUxanuz+v6Q37QA877FhwzNlrPHC3F6vynvvSSCfv0F48uMtS7g4yDWJfwwE00zoGDAmDd9aT+JViDe9ZW4zaqRH/ihRJKasYqCgNJQiuRQ5Zw/fvbTKiC+/rT3QvBvxPEfsCis92FT0L+Tc=; SPC_R_T_ID=LbgjMnAMf3tKQ70yQfUlLTzeKsLRRd4NmjBseI3h7SxEaEJ7Kr2ubCB9NY2TmIYCJONmC7BHDiWGRvGz6yQubWBnqMIvn6+1ufOz4AgQOFX6XrtMve6FNpxnB4iJitU0ylcN84tozAbTuv224QoGab/ja9fe6tz3Sh5/qXfsdsg=; SPC_R_T_IV=SGtHRlJ1Y0FWYUVrWERwbg==; SPC_SI=HjoQZAAAAABQNHRtY0pFUeIBEAAAAAAAMTNacXkxOFA=; SPC_ST=.OHI3Q0QzdDFnMzZJZHl2RorijnHH+9AlqQobhkqAnzif6oQwtrYU6ue21xrKXcYrF5JOExHMnrr0gR32Y+bEtlNJmz/IHwcL7el8yEfLyzK05K9juq8syKL5Mcde5PE+4xY83Pnc7aSoh032ASHYNhZjiH1Oieh4I7Rxx2slFmHjxHner3aFuVl6wZbcQ0a/XjleJI6a3yTdhQ9FjCWrBw==; SPC_T_ID=LbgjMnAMf3tKQ70yQfUlLTzeKsLRRd4NmjBseI3h7SxEaEJ7Kr2ubCB9NY2TmIYCJONmC7BHDiWGRvGz6yQubWBnqMIvn6+1ufOz4AgQOFX6XrtMve6FNpxnB4iJitU0ylcN84tozAbTuv224QoGab/ja9fe6tz3Sh5/qXfsdsg=; SPC_T_IV=SGtHRlJ1Y0FWYUVrWERwbg==; SPC_U=32022632',
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return json_decode($response);   
    }

    public function getDataAPI()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('URL_VOUCHER'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
