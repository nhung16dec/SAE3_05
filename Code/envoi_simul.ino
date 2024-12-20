void setup()
{
  Serial.begin(9600);
  int temp = random(19,23);
  int humid = random(50,70);
  int pression = random(980,1020);
  Serial.print(temp);
  Serial.print(";");
  Serial.print(humid);
  Serial.print(";");
  Serial.print(pression);
}
void loop()
{
}
