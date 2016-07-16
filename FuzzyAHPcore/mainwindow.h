
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

#ifndef MAINWINDOW_H
#define MAINWINDOW_H

#include <QMainWindow>
#include "myclass.h"
#include "criteriarow.h"
#include <QObject>
#include <QList>
// win linux
#include <Eigen/Dense>
#include <Eigen/Core>
#include <QtSql>
#include "qsqldriver.h"

namespace Ui {
class MainWindow;
}

class MainWindow : public QMainWindow
{
    Q_OBJECT

public:

    explicit MainWindow(QWidget *parent = 0);
    ~MainWindow();

    QList<CriteriaRow*> m_criteriaRowList;

public slots:
     void loadDataFromDBGlobalVariables();
     void saveGlobalVariables();
     //Section1
     void section1_clicked();
     void section1_toNext();
     void section1_saveResults();
     void section1_calculations();
     //Section2
     void section2_clicked();
     void section2_toNextCriterion();
     void section2_toNextSurveyed();
     void section2_saveResults();
     void section2_calculations();


private:

    Ui::MainWindow *ui;
    MyClass *myClass; // myClass member dont't has to be public

    //Section1
    int counter1;

	QSqlDatabase db;
    std::vector<std::vector <Eigen::Vector3f> > totalResults1;


    float wS1Appoggio;
    std::vector<float> wS1;

    //Section2
    int counter2_criterion;
    int counter2_surveyed;

    std::vector<Eigen::Vector3f> results2; //results for each page open
    std::vector<std::vector <Eigen::Vector3f> > totalResults2; //results of each surveyed, all criteria
    std::vector<std::vector <std::vector <Eigen::Vector3f> > > totalR2; //results of all surveyed

    float wS2Appoggio;
    std::vector<float> wS2;
    std::vector< std::vector<float> > wS2Total;


    int m,n,r;

    // database connection objects: table mapping
    QSqlTableModel *model;
    QSqlTableModel *quest;
    QSqlRelationalTableModel *preferences;
    QSqlRelationalTableModel *questions;
    QSqlRelationalTableModel *users;
    QSqlTableModel *user;
    QSqlRelationalTableModel *modelRel;
    QSqlRelationalTableModel *alternative;
    //Map
    QMap<int, QSqlRecord> preferencesMap;
    QMap<int, QSqlRecord> modelRelMap;
    QMap<int, QSqlRecord> alternativeMap;
    QMap<int, QSqlRecord> usersMap;
    QMap<int, QSqlRecord> questionsMap;
    int currentUser;
    QString currentQuest;

    int typeIndex;


private slots:

   // void section1Clicked();



};

#endif // MAINWINDOW_H

