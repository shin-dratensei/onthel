<?php
date_default_timezone_set('Asia/Jakarta');
include "function.php";
echo color("green","__________GUOJEK auto klaim voc BY FATIH V1.0__________ \n");
echo color("green","[+]  Time  : ".date('[d-m-Y] [H:i:s]')."   \n");
echo color("green","[+]  Recode  By: FATIH Surabaya\n");
echo color("green","[+]  Lebokno NOMER awalan 62xx yo!!! \n");
echo color("green","____________________________________________________\n");
function change(){
        $nama = nama();
        $email = str_replace(" ", "", $nama) . mt_rand(100, 999);
        ulang:
        echo color("nevy","(+) Ketiken nomere : ");
        $no = trim(fgets(STDIN));
        $data = '{"email":"'.$email.'@gmail.com","name":"'.$nama.'","phone":"+'.$no.'","signed_up_country":"ID"}';
        $register = request("/v5/customers", null, $data);
        if(strpos($register, '"otp_token"')){
        $otptoken = getStr('"otp_token":"','"',$register);
        echo color("green","+] Deloken notif ono sms bos ")."\n";
        otp:
        echo color("nevy","?] Otp: ");
        $otp = trim(fgets(STDIN));
        $data1 = '{"client_name":"gojek:cons:android","data":{"otp":"' . $otp . '","otp_token":"' . $otptoken . '"},"client_secret":"83415d06-ec4e-11e6-a41b-6c40088ab51e"}';
        $verif = request("/v5/customers/phone/verify", null, $data1);
        if(strpos($verif, '"access_token"')){
        echo color("green","+] wih mantap sukses ndaftar");
        $token = getStr('"access_token":"','"',$verif);
        $uuid = getStr('"resource_owner_id":',',',$verif);
        echo "\n".color("yellow","+] Your access token : ".$token."\n\n");
        save("token.txt",$token);
        echo "\n".color("nevy","?] langsung klaim voucher e bos?: y/n ");
        $pilihan = trim(fgets(STDIN));
        if($pilihan == "y" || $pilihan == "Y"){
        echo color("green","===========(NGEREDEEM VOUCHER)===========");
        echo "\n".color("yellow","!] Claim voc GORIDE ");
        echo "\n".color("yellow","!] sek entenono");
        echo "\e[!] Trying to redeem Voucher : GOFOODSANTAI19 !\n";
        sleep(3);
        $claim = claim($verif);
        if ($claim == false)
            {
            echo "\e[!]".$claim."\n";
            sleep(3);
            echo "\e[!] Trying to redeem Voucher : GOFOODSANTAI11 !\n";
            sleep(3);
            goto next;
            }
            else{
                echo "\e[+] ".$claim."\n";
                sleep(3);
                echo "\e[!] Trying to redeem Voucher : COBAINGOJEK !\n";
                sleep(3);
                goto ride;
            }
            next:
            $claim = claim1($verif);
            if ($claim == false) {
                echo "\e[!]".$claim['data']['message']."\n";
                sleep(3);
                echo "\e[!] Trying to redeem Voucher : GOFOODSANTAI08 !\n";
                sleep(3);
                goto next1;
            }
            else{
                echo "\e[+] ".$claim."\n";
                sleep(3);
                echo "\e[!] Trying to redeem Voucher : COBAINGOJEK !\n";
                sleep(3);
                goto ride;
            }
            next1:
            $claim = claim2($verif);
            if ($claim == false) {
                echo "\e[!]".$claim['errors'][0]['message']."\n";
                sleep(3);
                echo "\e[!] Trying to redeem Voucher : COBAINGOJEK !\n";
                sleep(3);
                goto ride;
            }
          else
            {
            echo "\e[+] ".$claim . "\n";
            sleep(3);
            echo "\e[!] Trying to redeem Voucher : COBAINGOJEK !\n";
            sleep(3);
            goto ride;
            }
            ride:
            $claim = ride($verif);
            if ($claim == false ) {
                echo "\e[!]".$claim['errors'][0]['message']."\n";
                sleep(3);
                echo "\e[!] Trying to redeem Voucher : AYOCOBAGOJEK !\n";
                sleep(3);

            }
            else{
                echo "\e[+] ".$claim."\n";
                sleep(3);
                echo "\e[!] Trying to redeem Voucher : AYOCOBAGOJEK !\n";
                sleep(3);
                goto pengen;
            }
            pengen:
            $claim = cekvocer($verif);
            if ($claim == false ) {
                echo "\VOUCHER INVALID/GAGAL REDEEM\n";
            }
            else{
                echo "\e[+] ".$claim."\n";
        sleep(3);
        $cekvoucher = request('/gopoints/v3/wallet/vouchers?limit=10&page=1', $token);
        $total = fetch_value($cekvoucher,'"total_vouchers":',',');
        $voucher3 = getStr1('"title":"','",',$cekvoucher,"3");
        $voucher1 = getStr1('"title":"','",',$cekvoucher,"1");
        $voucher2 = getStr1('"title":"','",',$cekvoucher,"2");
        $voucher4 = getStr1('"title":"','",',$cekvoucher,"4");
        $voucher5 = getStr1('"title":"','",',$cekvoucher,"5");
        $voucher6 = getStr1('"title":"','",',$cekvoucher,"6");
        echo "\n".color("yellow","!] Total voucher ".$total." : ");
        echo color("green","1. ".$voucher1);
        echo "\n".color("green","                     2. ".$voucher2);
        echo "\n".color("green","                     3. ".$voucher3);
        echo "\n".color("green","                     4. ".$voucher4);
        echo "\n".color("green","                     5. ".$voucher5);
        echo "\n".color("green","                     6. ".$voucher6);
        $expired1 = getStr1('"expiry_date":"','"',$cekvoucher,'1');
        $expired2 = getStr1('"expiry_date":"','"',$cekvoucher,'2');
        $expired3 = getStr1('"expiry_date":"','"',$cekvoucher,'3');
        $expired4 = getStr1('"expiry_date":"','"',$cekvoucher,'4');
        $expired5 = getStr1('"expiry_date":"','"',$cekvoucher,'5');
        $expired6 = getStr1('"expiry_date":"','"',$cekvoucher,'6');
         setpin:
         echo "\n".color("nevy","?] Mau set pin?: y/n ");
         $pilih1 = trim(fgets(STDIN));
         if($pilih1 == "y" || $pilih1 == "Y"){
         //if($pilih1 == "y" && strpos($no, "628")){
         echo color("red","========( PIN ANDA = 112233 )========")."\n";
         $data2 = '{"pin":"112233"}';
         $getotpsetpin = request("/wallet/pin", $token, $data2, null, null, $uuid);
         echo "Otp set pin: ";
         $otpsetpin = trim(fgets(STDIN));
         $verifotpsetpin = request("/wallet/pin", $token, $data2, null, $otpsetpin, $uuid);
         echo $verifotpsetpin;
         }else if($pilih1 == "n" || $pilih1 == "N"){
         die();
         }else{
         echo color("red","-] GAGAL!!!\n");
         }
         }
         }
         }
         
  }
 }
}
echo change()."\n"; ?>
