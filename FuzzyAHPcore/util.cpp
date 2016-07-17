#include "util.h"



int Util::connectToDB(QSqlDatabase db){
    int cok = 0;
    db = QSqlDatabase::addDatabase("QMYSQL");
    db.setHostName("localhost");
    db.setPort(3306);
    db.setDatabaseName("fuzzyahp");
    db.setUserName("root");
    db.setPassword("");
    if(db.isValid())
        cok =1;

    db.open();


    return cok;

}

Util::Util(){

}


