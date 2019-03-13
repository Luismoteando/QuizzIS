#define BUTTONS 3
int buttons[] = {2, 3, 4}; // Pulsadores
int pressed[] = {0, 0, 0}; // Presionado
int LEDs[] = {10, 11, 12}; // LEDs
char events[] = {'a', 'b', 'c'}; // Eventos
void setup() {
  for (int i = 0; i < BUTTONS; i++) {
    pinMode(buttons[i], INPUT); // Pulsadores
    pinMode(LEDs[i], OUTPUT); // LEDs
  }
  Serial.begin(9600); // Puerto serie
}
void setPressed(int i) {
  if (pressed[i])
    return;
  digitalWrite(LEDs[i], HIGH);
  pressed[i] = 1;
  Serial.println(events[i]);
}
void clearPressed(int i) {
  if (!pressed[i])
    return;
  digitalWrite(LEDs[i], LOW);
  pressed[i] = 0;
}
void loop() {
  for (int i = 0; i < BUTTONS; i++)
    if (digitalRead(buttons[i]) == HIGH)
      setPressed(i);
    else
      clearPressed(i);
  delay(10);
}
