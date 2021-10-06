#include <BLEDevice.h>
#include <BLEScan.h>
#include <BLEAdvertisedDevice.h>
#include <WiFi.h>
#include <HTTPClient.h>
 
const char* ssid = "AMORIM";
const char* password = "*DonaMaria2018";
String id_localizador = "1";
String list_Tags_in = "";
String list_Tags_fix = "";
String list_Tags_insert = "";
String list_Tags_del = "";  

class MyAdvertisedDeviceCallbacks: public BLEAdvertisedDeviceCallbacks {
    void onResult(BLEAdvertisedDevice advertisedDevice) {
      list_Tags_in.concat(advertisedDevice.getAddress().toString().c_str());
      list_Tags_in.concat(","); 
      //String strTemp = advertisedDevice.getAddress().toString().c_str(); 
      //if (strTemp != ""){
        //strTemp.concat(",");
        //list_Tags_in.concat(strTemp);            
      //}
    }
};

void setup() {
  Serial.begin(115200);
  delay(4000);
  list_Tags_in = "";
  list_Tags_fix = "";
  list_Tags_insert = "";
  list_Tags_del = "";    
}

void loop() {
  scanTags();
  delay(10000);
}

void scanTags(){
  Serial.println("Buscando equipamentos no local...");
  BLEDevice::init("");
  BLEScan* pBLEScan = BLEDevice::getScan();    
  pBLEScan->setAdvertisedDeviceCallbacks(new MyAdvertisedDeviceCallbacks());
  pBLEScan->setActiveScan(true);
  BLEScanResults foundDevices = pBLEScan->start(6);
  Serial.println("Fim da busca!");
  Serial.println("");
  conectaWifi();  
}

void conectaWifi(){
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Conectando WIFI...");
  }
  Serial.println("WIFI conectado.");  
  gravaTags();  
}

void gravaTags(){
  if ((WiFi.status() == WL_CONNECTED)) {  
    String url;  
    list_Tags_insert = "";
    list_Tags_del = "";
    String tempStr = "";    
    int indexDel;
    if (list_Tags_in.length() >= list_Tags_fix.length()) {       
      for(int i = 0; i < list_Tags_in.length(); i++){        
        if (list_Tags_in.charAt(i) != ','){
          tempStr.concat(list_Tags_in.charAt(i));
        } else {        
          if (list_Tags_in.indexOf(tempStr) == -1) {
            list_Tags_fix.concat(tempStr);
            list_Tags_fix.concat(",");  
          } else {
            if (list_Tags_fix.indexOf(tempStr) == -1) {
              list_Tags_fix.concat(tempStr);
              list_Tags_fix.concat(",");
              list_Tags_insert.concat(tempStr);
              list_Tags_insert.concat(",");
            }          
          }  
          tempStr = "";      
        }
      }
    } else {
      for (int x = 0; x < list_Tags_fix.length(); x++) {
        if (list_Tags_fix.charAt(x) != ',') {
          tempStr.concat(list_Tags_fix.charAt(x));   
        } else {
          if (list_Tags_in.indexOf(tempStr) == -1) {
            list_Tags_del.concat(tempStr);
            list_Tags_del.concat(",");
            if (list_Tags_fix.indexOf(tempStr) != -1) {
              list_Tags_fix.remove(list_Tags_fix.indexOf(tempStr), 18);
            }
          } else {
            list_Tags_in.remove(list_Tags_in.indexOf(tempStr), 18);
          }
          tempStr = "";        
        }
      }
    }

    Serial.println(list_Tags_insert);
    Serial.println(list_Tags_del);
    if (list_Tags_insert != ""){
      list_Tags_insert.remove(list_Tags_insert.length()-1, 1);
      url = "http://192.168.1.178/servico/acessoInformacao.php/registralogin/"+id_localizador+"/"+list_Tags_insert;
    }
  
    if (list_Tags_del != ""){
      list_Tags_del.remove(list_Tags_del.length()-1, 1);
      url = "http://192.168.1.178/servico/acessoInformacao.php/registralogout/"+id_localizador+"/"+list_Tags_del;        
    } 

      HTTPClient http;
      Serial.println(url);
      http.begin(url); 
      int httpCode = http.GET();                                        
      if (httpCode > 0) {
          String payload = http.getString();
          Serial.println(httpCode);
          Serial.println(payload);
      } else {
        Serial.println("Error on HTTP request");
      }
      list_Tags_in = "";
      http.end(); 
           

    WiFi.mode(WIFI_OFF); 
  }   
}
