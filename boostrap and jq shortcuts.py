# Keyboard module in Python
import keyboard
import pyperclip
import pyautogui
import time



def boostrap():
    boostrap_links = "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>\n<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p' crossorigin='anonymous'></script>"
    pyperclip.copy(boostrap_links)
    pyperclip.paste()
    pyautogui.hotkey('ctrl', 'v')
    time.sleep(.5)



def jquery():
    jquery_links = "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>"
    pyperclip.copy(jquery_links)
    pyperclip.paste()
    pyautogui.hotkey('ctrl', 'v')
    time.sleep(.5)


keyboard.add_hotkey('ctrl + shift + b', lambda: boostrap())
keyboard.add_hotkey('ctrl + shift + j', lambda: jquery())
