# -*- coding: utf-8 -*-
import sys
import Tkinter as tk
import requests
import myNotebook as nb
import keyring
from config import config

this = sys.modules[__name__]
this.s = None
this.prep = {}

def plugin_start():
    this.user = tk.StringVar(value=config.get("FacGuardUser"))
    this.password = tk.StringVar(value=keyring.get_password("EDMC-FacGuard", config.get("FacGuardUser")))
    return ('FacGuard')

def plugin_prefs(parent):
    frame = nb.Frame(parent)
    frame.columnconfigure(1, weight=1)

    user_label = nb.Label(
            frame
            , text="User Name"
            )
    user_label.grid(
            padx=10
            , row=10
            , sticky=tk.W
            )

    user_entry = nb.Entry(
            frame
            , textvariable=this.user
            )
    user_entry.grid(
            padx=10
            , row=10
            , column=1
            , sticky=tk.EW
            )

    password_label = nb.Label(
            frame
            , text="Password"
            )
    password_label.grid(
            padx=10
            , row=12
            , sticky=tk.W
            )

    password_entry = nb.Entry(
            frame
            , textvariable=this.password
            , show=u'•'
            )
    password_entry.grid(
            padx=10
            , row=12
            , column=1
            , sticky=tk.EW
            )

    return frame
