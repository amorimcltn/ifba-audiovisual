#include <BLEDevice.h>
#include <BLEScan.h>
#include <BLEAdvertisedDevice.h>
#include <WiFi.h>
#include <HTTPClient.h>
 
const char* ssid = "AMORIM";
const char* password = "*DonaMaria2018";
String list_Tags;

class MyAdvertisedDeviceCallbacks: public BLEAdvertisedDeviceCallbacks {
    void onResult(BLEAdvertisedDevice advertisedDevice) {
      list_Tags.concat(advertisedDevice.getAddress().toString().c_str());
      list_Tags.concat(",");         
    }
};

void setup() {
  Serial.begin(115200);
  delay(4000);
  list_Tags = "";
}

void loop() {
  scanTags();
  delay(10000);
}

void scanTags(){
  Serial.println("Buscando novos equipamentos...");
  list_Tags = "";
  BLEDevice::init("");
  BLEScan* pBLEScan = BLEDevice::getScan();    
  pBLEScan->setAdvertisedDeviceCallbacks(new MyAdvertisedDeviceCallbacks());
  pBLEScan->setActiveScan(true);
  BLEScanResults foundDevices = pBLEScan->start(6);
  Serial.println("Busca concluida.");
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
    if (list_Tags != "") {
      list_Tags.remove(list_Tags.length()-1, 1);
      url = "http://192.168.1.178/servico/acessoInformacao.php/gravatags/"+list_Tags;  
    } else {
      url = "http://192.168.1.178/servico/acessoInformacao.php/deletatags";
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
    list_Tags = "";
    http.end();
    WiFi.mode(WIFI_OFF); 
  }  
}
