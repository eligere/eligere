#-------------------------------------------------
#
# Project created by QtCreator 2015-08-25T15:29:36
#
#-------------------------------------------------

QT       += sql core gui

greaterThan(QT_MAJOR_VERSION, 4): QT += widgets

TARGET = Test
TEMPLATE = app

INCLUDEPATH += C:/eigen-eigen-6b38706d90a9/eigen-eigen-6b38706d90a9


SOURCES += main.cpp\
        mainwindow.cpp \
        myclass.cpp \
        criteriarow.cpp \
    util.cpp

HEADERS  += mainwindow.h \
    myclass.h \
    criteriarow.h \
    util.h

FORMS    += mainwindow.ui

DISTFILES += \
    ../build-Test-Desktop_Qt_5_5_0_MSVC2013_64bit-Debug/debug/mainwindow.obj
