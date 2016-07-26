#/**********************************************************************************************************
# *  <ELIGERE: a Fuzzy AHP Distributed Software Platform for Group Decision Making in Engineering Design>  *
# *   Copyright (C) 2016  by Mateusz Gospodarczyk and Stanislao Grazioso                                   *
# *  																									  *
# *   ELIGERE is free software: you can redistribute it and/or modify									  *
# *   it under the terms of the GNU General Public License as 											  *
# *   published by the Free Software Foundation, either version 3 of the 								  *
# *   License, or (at your option) any later version.													  *
# *																										  *
# *   This program is distributed in the hope that it will be useful,									  *
# *   but WITHOUT ANY WARRANTY; without even the implied warranty of										  *
# *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the										  *
# *   GNU General Public License for more details.														  *
# *																										  *
# *   You should have received a copy of the GNU General Public License									  *
# *   along with this program.  If not, see <http://www.gnu.org/licenses/>.								  *
# * 																										  *
# *   Contacts: mateusz.gospodarczyk@uniroma2.it and stanislao.grazioso@unina.it 						  *
# *********************************************************************************************************/


QT       += sql core gui network
greaterThan(QT_MAJOR_VERSION, 4): QT += widgets

TARGET = Test
TEMPLATE = app

INCLUDEPATH += C:/eigen-eigen-6b38706d90a9/eigen-eigen-6b38706d90a9


SOURCES += main.cpp\
           eligereserver.cpp\
           mainwindow.cpp \
           myclass.cpp \
           criteriarow.cpp \
           util.cpp \
           eligereserver.cpp

HEADERS  += mainwindow.h \
            eligereserver.h\
            myclass.h \
            criteriarow.h \
            util.h \
            eligereserver.h

FORMS    += mainwindow.ui

DISTFILES += \
    ../build-Test-Desktop_Qt_5_5_0_MSVC2013_64bit-Debug/debug/mainwindow.obj
