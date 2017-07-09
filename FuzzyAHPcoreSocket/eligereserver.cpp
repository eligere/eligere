/**********************************************************************************************************
 *  <ELIGERE: a Fuzzy AHP Distributed Software Platform for Group Decision Making in Engineering Design>  *
 *   Copyright (C) 2016  by Mateusz Gospodarczyk and Stanislao Grazioso                                   *
 *  																									  *
 *   ELIGERE is free software: you can redistribute it and/or modify									  *
 *   it under the terms of the GNU General Public License as 											  *
 *   published by the Free Software Foundation, either version 3 of the 								  *
 *   License, or (at your option) any later version.													  *
 *																										  *
 *   This program is distributed in the hope that it will be useful,									  *
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of										  *
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the										  *
 *   GNU General Public License for more details.														  *
 *																										  *
 *   You should have received a copy of the GNU General Public License									  *
 *   along with this program.  If not, see <http://www.gnu.org/licenses/>.								  *
 * 																										  *
 *   Contacts: mateusz.gospodarczyk@uniroma2.it and stanislao.grazioso@unina.it 						  *
 *********************************************************************************************************/
#include "eligereserver.h"
#include "mainwindow.h"

EligereServer::EligereServer(QObject *parent)
{

    server = new QTcpServer(this);

    connect(server,SIGNAL(newConnection()),this, SLOT(newConnection()));


    if(!server -> listen(QHostAddress::Any,8086)){

        qDebug() << "server could not start";

    }else{

        qDebug() << "server started";

    }



}

void EligereServer::newConnection(){

    qDebug() << "New Connection";

    QTcpSocket *socket = server->nextPendingConnection();

    socket->waitForReadyRead(100);
    socket->waitForBytesWritten(100);
    qDebug()<< "id_quest";
    QString a = (QString)socket->readAll();
    qDebug()<< a;
    QStringList list1 = a.split('=');
    qDebug()<< list1[1];

    socket->write("Survey elaborated with success\r\n");
    socket->flush();
    socket->close();


    MainWindow w;
    w.loadDataFromDBGlobalVariables(1,list1[1]);


}



//You need to re-run qmake for it to pick up the changes in .pro file. Go to Build->Run qmake. Now it should compile.
