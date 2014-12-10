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
int state_2 = 0;
int state_3 = 0;


char meg;
int cmd;
int lightNum = 0;
int turn = 0;
int sendback = 0;

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
    meg = Serial.read();
    cmd = int(meg);
    lightNum = cmd % 4;
    Serial.println(lightNum);
    turn = cmd / 4;
    
    switch(lightNum){
     case 1:
       digitalWrite(light_1, HIGH);
       digitalWrite_num_Not(lightNum, &state_1);
     break;
     case 2:
       digitalWrite_num_Not(lightNum, &state_2);
      break;
     case 3:
      digitalWrite_num_Not(lightNum, &state_3);
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
    CheckCurrent(&state_1, temp_1);
  //  CheckCurrent(&state_2, temp_2);
  //  CheckCurrent(&state_3, temp_3);
    
    sendback = 0;
    if(state_1 == 1) sendback |= 1;
    if(state_2 == 1) sendback |= 2;
    if(state_3 == 1) sendback |= 4;
    Serial.println(sendback);
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

void CheckCurrent(int * state, float temp){
  if(temp < 509){
    *state = 0;
  }else{
//    Serial.print("The switch ");
    *state = 1;
  }
 
}

void digitalWrite_num_Not(int num, int * state){
  
  *state = !(*state);
  if(*state == 0) digitalWrite(num, LOW);
  else digitalWrite(num, HIGH);
  
}
