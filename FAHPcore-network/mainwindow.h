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
#include <Eigen/Dense>
#include <Eigen/Core>
#include <QtSql>


namespace Ui {
class MainWindow;
}

class MainWindow : public QMainWindow
{
    Q_OBJECT

public:
    //MainWindow(QWidget *parent = 0, Qt::WFlags flags = 0);

    explicit MainWindow(QWidget *parent = 0);
    ~MainWindow();

    QList<CriteriaRow*> m_criteriaRowList;

public slots:
     void load();
     void loadDataFromDBGlobalVariables(int fast, QString socketQuestId);
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
     void info();

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


    int num_alternative,num_criteria,num_surveyed;

    // database connection objects: table mapping
    QSqlTableModel *model;
    QSqlTableModel *quest;
    QSqlTableModel *questionnaire;
    QSqlTableModel *linguistic_scale;
    QSqlTableModel *criteria;
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
    QMap<QString, int> linguisticMap;
    QMap<int, QSqlRecord> criteriaMap;

    int currentUser;
    int this_criterion;
    QString currentQuest;
    bool enableFastElaboration = false;
    int typeIndex;
    bool section2_calculations_more = true;
    bool section1_calculations_more = true;
    bool elaborationSurvey = true;
    int fast2 = 0;
    QString socketQuestId2 = "";

private slots:

   // void section1Clicked();



};

#endif // MAINWINDOW_H

