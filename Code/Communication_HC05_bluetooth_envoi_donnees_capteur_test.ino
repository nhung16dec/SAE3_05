#include <SoftwareSerial.h>      
#include <Wire.h>     
#include <Digital_Light_TSL2561.h>               
#include "DHT.h"
#include <Dps310.h>
#define rxPin 11
#define txPin 10
#define baudrate 9600
Dps310 Dps310PressureSensor = Dps310();
#define DHTPIN 2 //Broche utilisée par le DHT
#define DHTTYPE DHT22
DHT dht(DHTPIN, DHTTYPE);
// Dans ce programme, la broche RX du HC-05 est branchée sur la broche 10 de l'arduino (via un pont de résistance) et la broche TX du HC-05 est branchée sur la broche 11 de l'arduino.
float PressionNiveauMerPa=101325; 
int oversampling=7;
String msg;

SoftwareSerial HC05(rxPin ,txPin);

// Constants
#define DELAY 10000 // Delay between two measurements in ms

// Parameters
const int sensorPin = A0; // Pin connected to sensor

// Variables
float voltage;

void setup(void) {
  Serial.begin(9600);
  dht.begin();
  Wire.begin();
  HC05.begin(baudrate);
  TSL2561.init();
  Dps310PressureSensor.begin(Wire);
}

void loop(void) {
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  float l = TSL2561.readFSpecLuminosity();
  float pascals;
  float p;
  int ret = Dps310PressureSensor.measurePressureOnce(pascals, oversampling);
  if (ret!=0) {
    //Capteur non détecté
    Serial.print("Capteur DPS310 non détecté");
  }
  else{
    p = pascals;
    voltage= analogRead(sensorPin) * (5.0 / 1023.0); // Convert digital value to voltage
    Serial.println(String(t)+ ";" + String(h) + ";" + String(p) + ";" + String(l));
  
    // Send voltage and temperature value to app
    

    HC05.println(String(t)+ ";" + String(h) + ";" + String(p) + ";" + String(l));
  }
  delay(DELAY);  
}
