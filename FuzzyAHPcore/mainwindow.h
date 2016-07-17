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


    int num_alternative,num_criteria,num_surveyed;

    // database connection objects: table mapping
    QSqlTableModel *model;
    QSqlTableModel *quest;
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

private slots:

   // void section1Clicked();



};

#endif // MAINWINDOW_H

