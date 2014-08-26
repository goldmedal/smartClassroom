int light_1 = 2;
int light_2 = 3;
int light_3 = 4;
int ele_1 = A0;
int ele_2 = A1;
int ele_3 = A2;
float temp_1 = 0;
float temp_2 = 0;
float temp_3 = 0;
int i = 0;
float sum_1 = 0;
float sum_2 = 0;
float sum_3 = 0;
int state_1 = 0;

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
  if (Serial.available()) //connected
  {
    cmd = Serial.read();
    
    switch(cmd){
     case '1':
      digitalWrite(light_1, HIGH);
 //     Serial.println("turn off");
      break;
     case 'q':
      digitalWrite(light_1, LOW);
   //   Serial.println("turn on");
      break;
     case '2':
      digitalWrite(light_2, HIGH);
      break;
     case 'w':
      digitalWrite(light_2, LOW);
      break;    
     case '3':
      digitalWrite(light_3, HIGH);
      break;
     case 'e':
      digitalWrite(light_3, LOW);
      break;      
    }
     
  }
  
  if(i < 1000) {
    
   temp_1 = analogRead(ele_1);
   sum_1 = sum_1 + tempAdd(temp_1);
   temp_2 = analogRead(ele_2);
   sum_2 += tempAdd(temp_2);
   temp_3 = analogRead(ele_3);
   sum_3 += tempAdd(temp_3);
   i++;
   delay(1);
  }else {
    
    temp_1 = sqrtAdd(sum_1);
    sum_1 = 0;
    temp_2 = sqrtAdd(sum_2);
    sum_2 = 0;
    temp_3 = sqrtAdd(sum_3);
    sum_3 = 0;
    i = 0;
  //  Serial.println(temp_1);
    CheckCurrent(1, temp_1);
 //   CheckCurrent(2, temp_2);
 //   CheckCurrent(3, temp_3);
    
  }
  
}

float tempAdd(float temp){
  temp = temp - 512;
  temp = temp * temp;
  return 512 + temp;
}

float sqrtAdd(float temp){
   temp = temp / 1000;
   temp = sqrt(temp);
   return temp;
}

void CheckCurrent(int num, float temp){
  if(temp < 509){
//    Serial.print("The switch ");
    Serial.print(num);
    Serial.print("_");
    Serial.println(0); 
  }else{
//    Serial.print("The switch ");
    Serial.print(num);
    Serial.print("_");
    Serial.println(1);
  }
 
}
