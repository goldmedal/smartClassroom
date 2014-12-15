int light_1 = 2;
int light_2 = 3;
int light_3 = 4;
 
char cmd;

void setup()
{
  pinMode(light_1,OUTPUT);
  pinMode(light_2,OUTPUT);
  pinMode(light_3,OUTPUT);
 
  Serial.begin(9600); // 藍牙模組預設baud rate = 9600
  Serial.println("Connect success !");
}
 
void loop()
{
  
  int sensor = 0;
  if (Serial.available()) //connected
  {
    /*   meg format : num state
                       01 1
    */
    
    cmd = Serial.read();
    switch(cmd){
     case '0':
      digitalWrite(light_1, LOW);
      break;
     case '4':
      digitalWrite(light_1, HIGH);
      break;
     case 'a':
      sensor = A0;
      break;
     case '1':
      digitalWrite(light_2, LOW);
      break;
     case '5':
      digitalWrite(light_2, HIGH);
      break;
     case 's':
      sensor = A1;
      break;    
     case '2':
      digitalWrite(light_3, LOW);
      break;
     case '6':
      digitalWrite(light_3, HIGH);
      break;
     case 'd':
      sensor = A2;
      break;     
    }
  }
  
  int sensor_max = 0;
  if( sensor != 0){
    sensor_max = getMaxValue (sensor);  
    CheckCurrent(sensor, sensor_max);
  }
 
}

void CheckCurrent(int num, float temp){
    Serial.print(temp); 
}

int getMaxValue(int sensor_pin)
{
	float sensorValue;             //value read from the sensor
	float sensorMax = 0;
	uint32_t start_time = millis();
	while((millis()-start_time) < 1000)//sample for 1000ms
	{
		sensorValue = analogRead(sensor_pin);
		if (sensorValue > sensorMax) 
		{
			/*record the maximum sensor value*/
			sensorMax = sensorValue;
		}
	}
	return sensorMax;
}
