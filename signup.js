var category_name = "";
function disableSelected(){
    $(".c-list").each(function(i){
        $(this).css("background-color","white");
    });
    $(".selected").each(function(i){
        $(this).css("display","none");  
    });
}
function addLocation(){
    var address = document.getElementById('street').value+" "+document.getElementById('town').value+" "+document.getElementById('city').value;
    
    getLocation(address);
}
function displayNone(){
    $(".skills").each(function(i){
        $(this).hide();
    });
    $(".aadhar").hide();
}
function displaySkills(name){
    displayNone();
    category_name = name;
    if(name === "Volunteer") {
        $(".vol-details").show();
        $(".aadhar").show();
    }
    else if(name === "Essential Worker") {
        $(".ess-details").show();
        $(".aadhar").show();
    }
    else if(name === "Doctor") {
        $(".doc-details").show();
        $(".aadhar").show();
    }
}
function checkCategory(){
    var cflag = false;
    $(".selected").each(function(i){
        if($(this).css("display") === "block"){
            displaySkills($(this).siblings(".text").html());
            cflag = true;
        }
    });
    return cflag;
}
function validate(name){
    var inp, vflag = true;
    $(name).each(function(){
        inp = $(this).find(':input,select');
        $(inp).each(function(i){
            if(!$(this).parents('#mapAll').length &&  $(this).is(":visible") && inp[i].value === ""){
                vflag = false;
                return;
            }
        });
    });
    return vflag;
}
function checkPass(){
    var check = $(".pass").find(":input");
    if(check[0].value === check[1].value) return true;
    else return false;
}
$(document).keydown(function(e) {
    if (e.keyCode == 9) {
        e.preventDefault();
        alertBox('Restricted Tab Action!',"This page prevents tab action, so please consider using mouse for navigating.. :)",0);
    }
});
var id;
$(document).ready(function(){
    $(".c-list").click(function(){
        disableSelected();
        $(this).css("background-color","rgba(49,110,164,0.25)");
        $(this).children(".selected").css("display","block");
    });
    $(".pers-button").click(function(){
        window.scrollTo(0,0);
        if(checkCategory()){
            $(".main-cat").html(category_name);
            id = category_name;
            $(".select-category").css("left","-100%");
            $(".personal").css("left","0%");
            $(".two").addClass("finished");
            $(".one-line").addClass("active");
        }
        else alertBox("Please select a category to continue",'',0);
    });
    $(".loc-button").click(function(){
        window.scrollTo(0,0);
        if(validate(".personal")){
            $(".personal").css("left","-100%");
            $(".location").css("left","0%");
            $(".three").addClass("finished");
            $(".two-line").addClass("active");
        }
        else alertBox("Please fill in all the fields",'',0);
    });
    $(".pass-button").click(function(){
        window.scrollTo(0,0);
        if(validate(".location")){
            $(".location").css("left","-100%");
            $(".pass").css("left","0%");
            $(".four").addClass("finished");
            $(".three-line").addClass("active");
        }
        else alertBox("Please fill in all the fields",'',0);
    });
    $(".pers-back").click(function(){
        window.scrollTo(0,0);
        $(".location").css("left","100%");
        $(".personal").css("left","0%");
        $(".three").removeClass("finished");
        $(".two-line").removeClass("active");
    });
    $(".cat-back").click(function(){
        window.scrollTo(0,0);
        $(".personal").css("left","100%");
        $(".select-category").css("left","0%");
        $(".two").removeClass("finished");
        $(".one-line").removeClass("active");
    });
    $(".loc-back").click(function(){
        window.scrollTo(0,0);
        $(".pass").css("left","100%");
        $(".location").css("left","0%");
        $(".four").removeClass("finished");
        $(".three-line").removeClass("active");
    });
    $(".signup").click(function(){
        if(validate(".pass")){
            if(checkPass()){
                //Make an Ajax POST call for signup action!
                var formObj = new Object();
                var timer = [];

                var result = $(".form-wrap").find(":input,select");
                result.each(function(i){
                    if($(this).is(":visible")){
                        var id = $(this).attr('id');
                        if(id === "start" || id === "end"){
                            timer.push(result[i].value)
                            formObj["slots"] = timer;
                        }
                        else formObj[id] = result[i].value;
                    }
                });
                var marker = returnMarker();
                var lat = marker.getPosition().lat();
                var lng = marker.getPosition().lng();
                formObj['lat'] = lat;
                formObj['lng'] = lng;
                
                if(id == 'General User')
                id = 'G';
                else if(id == 'Volunteer')
                id = 'V';
                else if(id == 'Doctor')
                {
                id = 'D';
                var slots = formObj['slots'];
                var str="";
                for(var i=0;i<slots.length;i+=2){
                    str+=slots[i]+'-'+slots[i+1]+';';
                }
                str = str.substring(0, str.length-1);
                formObj['working_hours'] = str;
            }
                else if(id == 'Essential Worker')
                id = 'E';
                
                console.log(formObj,id);
                $.ajax({
                    url: "signupAction.php?"+id+"=true",
                    type: "post",
                    data : JSON.stringify(formObj),
                    dataType: 'text',
                    success: function (data) {
                        console.log(data);
                        alertBox("Signup Successful",'',2,data);
                    },
                    error: function(data) {
                        alertBox("Signup Failed",'Try Again Later!',1);
                    }


                });
                
            }
            else alertBox("Retype password correctly",'',1);
        }
        else alertBox("Please fill in all the fields",'',0);
    });    
});
$(document).ready(function(){
    var slot_count = 1;
    $(".addSlot").click(function(){
        if(slot_count == 3){
            alert("Cannot add additional time slots!!");
        }
        else{
            $(".time-wrap:last").after('<div class="time-wrap"><div class="input-wrap time-slot"><input type="text" name="" id="start" required><label for="start">Start Time</label></div><div class="input-wrap time-slot"><input type="text" name="" id="end" required><label for="end">End Time</label></div><div class="removeSlot">-</div></div>');
            slot_count++;
        }
    });
    $(document).on('click','.removeSlot',function(){
        $(this).parent().remove();
        slot_count--;
    });
});
var obj = JSON.parse('{"Andaman and Nicobar Islands":["Port Blair "],"Andhra Pradesh":["Adoni","Amalapuram","Anakapalle","Anantapur","Bapatla","Bheemunipatnam","Bhimavaram","Bobbili","Chilakaluripet","Chirala","Chittoor","Dharmavaram","Eluru","Gooty","Gudivada","Gudur","Guntakal","Guntur","Hindupur","Jaggaiahpet","Jammalamadugu","Kadapa","Kadiri","Kakinada","Kandukur","Kavali","Kovvur","Kurnool","Macherla","Machilipatnam","Madanapalle","Mandapeta","Markapur","Nagari","Naidupet","Nandyal","Narasapuram","Narasaraopet","Narsipatnam","Nellore","Nidadavole","Nuzvid","Ongole","Palacole","Palasa Kasibugga","Parvathipuram","Pedana","Peddapuram","Pithapuram","Ponnur","Proddatur","Punganur","Puttur","Rajahmundry","Rajam","Rajampet","Ramachandrapuram","Rayachoti","Rayadurg","Renigunta","Repalle","Salur","Samalkot","Sattenapalle","Srikakulam","Srikalahasti","Srisailam Project (Right Flank Colony) Township","Sullurpeta","Tadepalligudem","Tadpatri","Tanuku","Tenali","Tirupati","Tiruvuru","Tuni","Uravakonda","Venkatagiri","Vijayawada","Vinukonda","Visakhapatnam","Vizianagaram","Yemmiganur","Yerraguntla"],"Arunachal Pradesh":["Naharlagun","Pasighat"],"Assam":["Barpeta","Bongaigaon City","Dhubri","Dibrugarh","Diphu","Goalpara","Guwahati","Jorhat","Karimganj","Lanka","Lumding","Mangaldoi","Mankachar","Margherita","Mariani","Marigaon","Nagaon","Nalbari","North Lakhimpur","Rangia","Sibsagar","Silapathar","Silchar","Tezpur","Tinsukia"],"Bihar":["Araria","Arrah","Arwal","Asarganj","Aurangabad","Bagaha","Barh","Begusarai","Bettiah","Bhabua","Bhagalpur","Buxar","Chhapra","Darbhanga","Dehri-on-Sone","Dumraon","Forbesganj","Gaya","Gopalganj","Hajipur","Jamalpur","Jamui","Jehanabad","Katihar","Kishanganj","Lakhisarai","Lalganj","Madhepura","Madhubani","Maharajganj","Mahnar Bazar","Makhdumpur","Maner","Manihari","Marhaura","Masaurhi","Mirganj","Mokameh","Motihari","Motipur","Munger","Murliganj","Muzaffarpur","Narkatiaganj","Naugachhia","Nawada","Nokha","Patna","Piro","Purnia","Rafiganj","Rajgir","Ramnagar","Raxaul Bazar","Revelganj","Rosera","Saharsa","Samastipur","Sasaram","Sheikhpura","Sheohar","Sherghati","Silao","Sitamarhi","Siwan","Sonepur","Sugauli","Sultanganj","Supaul","Warisaliganj"],"Chandigarh":["Chandigarh"],"Chhattisgarh":["Ambikapur","Bhatapara","Bhilai Nagar","Bilaspur","Chirmiri","Dalli-Rajhara","Dhamtari","Durg","Jagdalpur","Korba","Mahasamund","Manendragarh","Mungeli","Naila Janjgir","Raigarh","Raipur","Rajnandgaon","Sakti","Tilda Newra"],"Dadra and Nagar Haveli":["Silvassa"],"Delhi":["Delhi","New Delhi"],"Goa":["Mapusa","Margao","Marmagao","Panaji"],"Gujarat":["Adalaj","Ahmedabad","Amreli","Anand","Anjar","Ankleshwar","Bharuch","Bhavnagar","Bhuj","Chhapra","Deesa","Dhoraji","Godhra","Jamnagar","Kadi","Kapadvanj","Keshod","Khambhat","Lathi","Limbdi","Lunawada","Mahesana","Mahuva","Manavadar","Mandvi","Mangrol","Mansa","Mahemdabad","Modasa","Morvi","Nadiad","Navsari","Padra","Palanpur","Palitana","Pardi","Patan","Petlad","Porbandar","Radhanpur","Rajkot","Rajpipla","Rajula","Ranavav","Rapar","Salaya","Sanand","Savarkundla","Sidhpur","Sihor","Songadh","Surat","Talaja","Thangadh","Tharad","Umbergaon","Umreth","Una","Unjha","Upleta","Vadnagar","Vadodara","Valsad","Vapi","Vapi","Veraval","Vijapur","Viramgam","Visnagar","Vyara","Wadhwan","Wankaner"],"Haryana":["Bahadurgarh","Bhiwani","Charkhi Dadri","Faridabad","Fatehabad","Gohana","Gurgaon","Hansi","Hisar","Jind","Kaithal","Karnal","Ladwa","Mahendragarh","Mandi Dabwali","Narnaul","Narwana","Palwal","Panchkula","Panipat","Pehowa","Pinjore","Rania","Ratia","Rewari","Rohtak","Safidon","Samalkha","Sarsod","Shahbad","Sirsa","Sohna","Sonipat","Taraori","Thanesar","Tohana","Yamunanagar"],"Himachal Pradesh":["Mandi","Nahan","Palampur","Shimla","Solan","Sundarnagar"],"Jammu and Kashmir":["Anantnag","Baramula","Jammu","Kathua","Punch","Rajauri","Sopore","Srinagar","Udhampur"],"Jharkhand":["Adityapur","Bokaro Steel City","Chaibasa","Chatra","Chirkunda","Medininagar (Daltonganj)","Deoghar","Dhanbad","Dumka","Giridih","Gumia","Hazaribag","Jamshedpur","Jhumri Tilaiya","Lohardaga","Madhupur","Mihijam","Musabani","Pakaur","Patratu","Phusro","Ramgarh","Ranchi","Sahibganj","Saunda","Simdega","Tenu dam-cum-Kathhara"],"Karnataka":["Adyar","Afzalpur","Arsikere","Athni","Bengaluru","Belagavi","Ballari","Chikkamagaluru","Davanagere","Gokak","Hubli-Dharwad","Karwar","Kolar","Lakshmeshwar","Lingsugur","Maddur","Madhugiri","Madikeri","Magadi","Mahalingapura","Malavalli","Malur","Mandya","Mangaluru","Manvi","Mudalagi","Mudabidri","Muddebihal","Mudhol","Mulbagal","Mundargi","Mysore","Nanjangud","Nargund","Navalgund","Nelamangala","Pavagada","Piriyapatna","Puttur","Rabkavi Banhatti","Raayachuru","Ranebennuru","Ramanagaram","Ramdurg","Ranibennur","Robertson Pet","Ron","Sadalagi","Sagara","Sakaleshapura","Sindagi","Sanduru","Sankeshwara","Saundatti-Yellamma","Savanur","Sedam","Shahabad","Shahpur","Shiggaon","Shikaripur","Shivamogga","Surapura","Shrirangapattana","Sidlaghatta","Sindhagi","Sindhnur","Sira","Sirsi","Siruguppa","Srinivaspur","Tarikere","Tekkalakote","Terdal","Talikota","Tiptur","Tumkur","Udupi","Vijayapura","Wadi","Yadgir"],"Kerala":["Adoor","Alappuzha","Attingal","Chalakudy","Changanassery","Cherthala","Chittur-Thathamangalam","Guruvayoor","Kanhangad","Kannur","Kasaragod","Kayamkulam","Kochi","Kodungallur","Kollam","Kottayam","Kozhikode","Kunnamkulam","Malappuram","Mattannur","Mavelikkara","Mavoor","Muvattupuzha","Nedumangad","Neyyattinkara","Nilambur","Ottappalam","Palai","Palakkad","Panamattom","Panniyannur","Pappinisseri","Paravoor","Pathanamthitta","Peringathur","Perinthalmanna","Perumbavoor","Ponnani","Punalur","Puthuppally","Koyilandy","Shoranur","Taliparamba","Thiruvalla","Thiruvananthapuram","Thodupuzha","Thrissur","Tirur","Vaikom","Varkala","Vatakara"],"Madhya Pradesh":["Alirajpur","Ashok Nagar","Balaghat","Bhopal","Ganjbasoda","Gwalior","Indore","Itarsi","Jabalpur","Lahar","Maharajpur","Mahidpur","Maihar","Malaj Khand","Manasa","Manawar","Mandideep","Mandla","Mandsaur","Mauganj","Mhow Cantonment","Mhowgaon","Morena","Multai","Mundi","Murwara (Katni)","Nagda","Nainpur","Narsinghgarh","Narsinghgarh","Neemuch","Nepanagar","Niwari","Nowgong","Nowrozabad (Khodargama)","Pachore","Pali","Panagar","Pandhurna","Panna","Pasan","Pipariya","Pithampur","Porsa","Prithvipur","Raghogarh-Vijaypur","Rahatgarh","Raisen","Rajgarh","Ratlam","Rau","Rehli","Rewa","Sabalgarh","Sagar","Sanawad","Sarangpur","Sarni","Satna","Sausar","Sehore","Sendhwa","Seoni","Seoni-Malwa","Shahdol","Shajapur","Shamgarh","Sheopur","Shivpuri","Shujalpur","Sidhi","Sihora","Singrauli","Sironj","Sohagpur","Tarana","Tikamgarh","Ujjain","Umaria","Vidisha","Vijaypur","Wara Seoni"],"Maharashtra":["Ahmednagar","Akola","Akot","Amalner","Ambejogai","Amravati","Anjangaon","Arvi","Aurangabad","Bhiwandi","Dhule","Kalyan-Dombivali","Ichalkaranji","Kalyan-Dombivali","Karjat","Latur","Loha","Lonar","Lonavla","Mahad","Malegaon","Malkapur","Mangalvedhe","Mangrulpir","Manjlegaon","Manmad","Manwath","Mehkar","Mhaswad","Mira-Bhayandar","Morshi","Mukhed","Mul","Greater Mumbai","Murtijapur","Nagpur","Nanded-Waghala","Nandgaon","Nandura","Nandurbar","Narkhed","Nashik","Navi Mumbai","Nawapur","Nilanga","Osmanabad","Ozar","Pachora","Paithan","Palghar","Pandharkaoda","Pandharpur","Panvel","Parbhani","Parli","Partur","Pathardi","Pathri","Patur","Pauni","Pen","Phaltan","Pulgaon","Pune","Purna","Pusad","Rahuri","Rajura","Ramtek","Ratnagiri","Raver","Risod","Sailu","Sangamner","Sangli","Sangole","Sasvad","Satana","Satara","Savner","Sawantwadi","Shahade","Shegaon","Shendurjana","Shirdi","Shirpur-Warwade","Shirur","Shrigonda","Shrirampur","Sillod","Sinnar","Solapur","Soyagaon","Talegaon Dabhade","Talode","Tasgaon","Thane","Tirora","Tuljapur","Tumsar","Uchgaon","Udgir","Umarga","Umarkhed","Umred","Uran","Uran Islampur","Vadgaon Kasba","Vaijapur","Vasai-Virar","Vita","Wadgaon Road","Wai","Wani","Wardha","Warora","Warud","Washim","Yavatmal","Yawal","Yevla"],"Manipur":["Imphal","Lilong","Mayang Imphal","Thoubal"],"Meghalaya":["Nongstoin","Shillong","Tura"],"Mizoram":["Aizawl","Lunglei","Saiha"],"Nagaland":["Dimapur","Kohima","Mokokchung","Tuensang","Wokha","Zunheboto"],"Odisha":["Balangir","Baleshwar Town","Barbil","Bargarh","Baripada Town","Bhadrak","Bhawanipatna","Bhubaneswar","Brahmapur","Byasanagar","Cuttack","Dhenkanal","Jatani","Jharsuguda","Kendrapara","Kendujhar","Malkangiri","Nabarangapur","Paradip","Parlakhemundi","Pattamundai","Phulabani","Puri","Rairangpur","Rajagangapur","Raurkela","Rayagada","Sambalpur","Soro","Sunabeda","Sundargarh","Talcher","Tarbha","Titlagarh"],"Puducherry":["Karaikal","Mahe","Pondicherry","Yanam"],"Punjab":["Amritsar","Barnala","Batala","Bathinda","Dhuri","Faridkot","Fazilka","Firozpur","Firozpur Cantt.","Gobindgarh","Gurdaspur","Hoshiarpur","Jagraon","Jalandhar Cantt.","Jalandhar","Kapurthala","Khanna","Kharar","Kot Kapura","Longowal","Ludhiana","Malerkotla","Malout","Mansa","Moga","Mohali","Morinda, India","Mukerian","Muktsar","Nabha","Nakodar","Nangal","Nawanshahr","Pathankot","Patiala","Pattran","Patti","Phagwara","Phillaur","Qadian","Raikot","Rajpura","Rampura Phul","Rupnagar","Samana","Sangrur","Sirhind Fatehgarh Sahib","Sujanpur","Sunam","Talwara","Tarn Taran","Urmar Tanda","Zira","Zirakpur"],"Rajasthan":["Ajmer","Alwar","Bikaner","Bharatpur","Bhilwara","Jaipur","Jodhpur","Lachhmangarh","Ladnu","Lakheri","Lalsot","Losal","Makrana","Malpura","Mandalgarh","Mandawa","Mangrol","Merta City","Mount Abu","Nadbai","Nagar","Nagaur","Nasirabad","Nathdwara","Neem-Ka-Thana","Nimbahera","Nohar","Nokha","Pali","Phalodi","Phulera","Pilani","Pilibanga","Pindwara","Pipar City","Prantij","Pratapgarh","Raisinghnagar","Rajakhera","Rajaldesar","Rajgarh (Alwar)","Rajgarh (Churu)","Rajsamand","Ramganj Mandi","Ramngarh","Ratangarh","Rawatbhata","Rawatsar","Reengus","Sadri","Sadulshahar","Sadulpur","Sagwara","Sambhar","Sanchore","Sangaria","Sardarshahar","Sawai Madhopur","Shahpura","Shahpura","Sheoganj","Sikar","Sirohi","Sojat","Sri Madhopur","Sujangarh","Sumerpur","Suratgarh","Taranagar","Todabhim","Todaraisingh","Tonk","Udaipur","Udaipurwati","Vijainagar, Ajmer"],"Sikkim":["East Sikkim","West Sikkim","North Sikkim","South Sikkim"],"Tamil Nadu":["Arakkonam","Aruppukkottai","Chennai","Coimbatore","Erode","Gobichettipalayam","Kancheepuram","Karur","Lalgudi","Madurai","Manachanallur","Nagapattinam","Nagercoil","Namagiripettai","Namakkal","Nandivaram-Guduvancheri","Nanjikottai","Natham","Nellikuppam","Neyveli (TS)","O Valley","Oddanchatram","P.N.Patti","Pacode","Padmanabhapuram","Palani","Palladam","Pallapatti","Pallikonda","Panagudi","Panruti","Paramakudi","Parangipettai","Pattukkottai","Perambalur","Peravurani","Periyakulam","Periyasemur","Pernampattu","Pollachi","Polur","Ponneri","Pudukkottai","Pudupattinam","Puliyankudi","Punjaipugalur","Ranipet","Rajapalayam","Ramanathapuram","Rameshwaram","Rasipuram","Salem","Sankarankoil","Sankari","Sathyamangalam","Sattur","Shenkottai","Sholavandan","Sholingur","Sirkali","Sivaganga","Sivagiri","Sivakasi","Srivilliputhur","Surandai","Suriyampalayam","Tenkasi","Thammampatti","Thanjavur","Tharamangalam","Tharangambadi","Theni Allinagaram","Thirumangalam","Thirupuvanam","Thiruthuraipoondi","Thiruvallur","Thiruvarur","Thuraiyur","Tindivanam","Tiruchendur","Tiruchengode","Tiruchirappalli","Tirukalukundram","Tirukkoyilur","Tirunelveli","Tirupathur","Tirupathur","Tiruppur","Tiruttani","Tiruvannamalai","Tiruvethipuram","Tittakudi","Udhagamandalam","Udumalaipettai","Unnamalaikadai","Usilampatti","Uthamapalayam","Uthiramerur","Vadakkuvalliyur","Vadalur","Vadipatti","Valparai","Vandavasi","Vaniyambadi","Vedaranyam","Vellakoil","Vellore","Vikramasingapuram","Viluppuram","Virudhachalam","Virudhunagar","Viswanatham"],"Telangana":["Adilabad","Bellampalle","Bhadrachalam","Bhainsa","Bhongir","Bodhan","Farooqnagar","Gadwal","Hyderabad","Jagtial","Jangaon","Kagaznagar","Kamareddy","Karimnagar","Khammam","Koratla","Kothagudem","Kyathampalle","Mahbubnagar","Mancherial","Mandamarri","Manuguru","Medak","Miryalaguda","Nagarkurnool","Narayanpet","Nirmal","Nizamabad","Palwancha","Ramagundam","Sadscroll-behavior: smooth;asivpet","Sangareddy","Siddipet","Sircilla","Suryapet","Tandur","Vikarabad","Wanaparthy","Warangal","Yellandu"],"Tripura":["Agartala","Belonia","Dharmanagar","Kailasahar","Khowai","Pratapgarh","Udaipur"],"Uttar Pradesh":["Achhnera","Agra","Aligarh","Allahabad","Amroha","Azamgarh","Bahraich","Chandausi","Etawah","Firozabad","Fatehpur Sikri","Hapur","Hardoi ","Jhansi","Kalpi","Kanpur","Khair","Laharpur","Lakhimpur","Lal Gopalganj Nindaura","Lalitpur","Lalganj","Lar","Lohow to adjust height according to div htmlni","Lucknow","Mathura","Meerut","Modinagar","Moradabad","Nagina","Najibabad","Nakur","Nanpara","Naraura","Naugawan Sadat","Nautanwa","Nawabganj","Nehtaur","Niwai","Noida","Noorpur","Obra","Orai","Padrauna","Palia Kalan","Parasi","Phulpur","Pihani","Pilibhit","Pilkhuwa","Powayan","Pukhrayan","Puranpur","Purquazi","Purwa","Rae Bareli","Rampur","Rampur Maniharan","Rampur Maniharan","Rasra","Rath","Renukoot","Reoti","Robertsganj","Rudauli","Rudrapur","Sadabad","Safipur","Saharanpur","Sahaspur","Sahaswan","Sahawar","Sahjanwa","Saidpur","Sambhal","Samdhan","Samthar","Sandi","Sandila","Sardhana","Seohara","Shahabad, Hardoi","Shahabad, Rampur","Shahganj","Shahjahanpur","Shamli","Shamsabad, Agra","Shamsabad, Farrukhabad","Sherkot","Shikarpur, Bulandshahr","Shikohabad","Shishgarh","Siana","Sikanderpur","Sikandra Rao","Sikandrabad","Sirsaganj","Sirsi","Sitapur","Soron","Suar","Sultanpur","Sumerpur","Tanda","Thakurdwara","Thana Bhawan","Tilhar","Tirwaganj","Tulsipur","Tundla","Ujhani","Unnao","Utraula","Varanasi","Vrindavan","Warhapur","Zaidpur","Zamania"],"Uttarakhand":["Bageshwar","Dehradun","Haldwani-cum-Kathgodam","Hardwar","Kashipur","Manglaur","Mussoorie","Nagla","Nainital","Pauri","Pithoragarh","Ramnagar","Rishikesh","Roorkee","Rudrapur","Sitarganj","Srinagar","Tehri"],"West Bengal":["Adra","Alipurduar","Arambagh","Asansol","Baharampur","Balurghat","Bankura","Darjiling","English Bazar","Gangarampur","Habra","Hugli-Chinsurah","Jalpaiguri","Jhargram","Kalimpong","Kharagpur","Kolkata","Mainaguri","Malda","Mathabhanga","Medinipur","Memari","Monoharpur","Murshidabad","Nabadwip","Naihati","Panchla","Pandua","Paschim Punropara","Purulia","Raghunathpur","Raghunathganj","Raiganj","Rampurhat","Ranaghat","Sainthia","Santipur","Siliguri","Sonamukhi","Srirampore","Suri","Taki","Tamluk","Tarakeswar"]}');
function addCities(city){
    if(city !== ""){
        for(var i = 0; i < obj[city].length; i++){
            $("#city").append(new Option(obj[city][i],obj[city][i]));
        }
    }
}
$(document).ready(function(){
    var keys = Object.keys(obj);
    for(i = 0; i < keys.length; i++){
        $("#state").append(new Option(keys[i],keys[i]));
    }
    var selected_name;
    $("#state").change(function(){
        selected_name = $("#state").find(":selected").text();
        $("#city").find('option').remove();
        $("#city").append(new Option("",""));
        addCities(selected_name);
    });
});