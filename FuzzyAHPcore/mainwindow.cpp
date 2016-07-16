
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

#include "mainwindow.h"
#include "ui_mainwindow.h"
#include "criteriarow.h"
#include <QDebug>
#include <QString>
#include <QPushButton>
#include <QCheckBox>
#include <QRadioButton>
#include <Eigen\Dense>
#include <iostream>
#include <QTableView>
#include <QStandardItemModel>
#include <vector>
#include <string>
#include <iostream>
#include <qlist.h>
#include <Qstring>
#include <Eigen/src/Core/Matrix.h>
#include <QButtonGroup>
#include <QWidget>
#include <QTableWidget>
#include "util.h"


MainWindow::MainWindow(QWidget *parent) :
	QMainWindow(parent),
	ui(new Ui::MainWindow)
	
{
	ui->setupUi(this);



    Util util;
    if(util.connectToDB(db) == 1 )
        ui->fuzzyResultsOnscreen->setText("DB CONNECTION: OK");
    else
        ui->fuzzyResultsOnscreen->setText("DB CONNECTION: ERROR ");




    //select all quest for the combo
    quest = new QSqlTableModel(this);
    quest->setTable("questionnaire");
    quest->setEditStrategy(QSqlTableModel::OnManualSubmit);
    quest->select();
    quest->rowCount();
    QTableView *view = new QTableView;
    ui->questionnarie->setModel(quest);
    ui->questionnarie->setView(view);



    // Initialize MyClass with the MainWindow-ui
    myClass = new MyClass(ui);
    //Pushbuttons
    //Global
    connect(ui->questOK, SIGNAL(clicked()), SLOT(loadDataFromDBGlobalVariables()));
    connect(ui->pushButton_Ok, SIGNAL(clicked()), SLOT(saveGlobalVariables()));
    //Section1
    connect(ui->pushButton_section1, SIGNAL(clicked()), SLOT(section1_clicked()));
    connect(ui->pushButton_section1_toNextSurveyed, SIGNAL(clicked()), SLOT(section1_toNext()));
    connect(ui->pushButton_section1_saveTheResults, SIGNAL(clicked()), SLOT(section1_saveResults()));
    connect(ui->pushButton_section1_calculations, SIGNAL(clicked()), SLOT(section1_calculations()));
    //Section2
    connect(ui->pushButton_section2, SIGNAL(clicked()), SLOT(section2_clicked()));
    connect(ui->pushButton_section2_saveTheResults, SIGNAL(clicked()), SLOT(section2_saveResults()));
    connect(ui->pushButton_section2_toNextCriterion, SIGNAL(clicked()), SLOT(section2_toNextCriterion()));
    connect(ui->pushButton_section2_toNextSurveyed, SIGNAL(clicked()), SLOT(section2_toNextSurveyed()));
    connect(ui->pushButton_section2_calculations, SIGNAL(clicked()), SLOT(section2_calculations()));

    //Boxes initialized to be hide
    //Section1
    ui->spinBox_section1_surveyedNumber->hide();
    ui->label_section1_surveyedNumber->hide();
    ui->pushButton_section1_saveTheResults->hide();
    ui->pushButton_section1_toNextSurveyed->hide();
    ui->label_section1_endSurveyed->hide();
    //Section2
    ui->spinBox_section2_surveyedNumber->hide();
    ui->label_section2_surveyedNumber->hide();
    ui->spinBox_section2_criterionNumber->hide();
    ui->label_section2_criterionNumber->hide();
    ui->pushButton_section2_saveTheResults->hide();
    ui->pushButton_section2_toNextCriterion->hide();
    ui->pushButton_section2_toNextSurveyed->hide();
    ui->label_section2_endCriterion->hide();
    ui->label_section2_endSurveyed->hide();

}

MainWindow::~MainWindow()
{
    delete myClass;
    delete ui;
    db.close();
}

//TODO
void MainWindow::loadDataFromDBGlobalVariables()
{


    ui->lineEdit->clear();
    ui->lineEdit->setText("LOAD DATA FROM DB");
    ui->lineEdit->setReadOnly(true);
    currentQuest =  ui->questionnarie->currentText();
    qDebug() << "current data" << ui->questionnarie->currentText();


    ui->fuzzyResultsOnscreen->setText("Function: loadDataFromDBGlobalVariables");
    modelRel = new QSqlRelationalTableModel(this);
    modelRel->setTable("criteria_alternative");
    modelRel->setEditStrategy(QSqlTableModel::OnManualSubmit);
    typeIndex = modelRel->fieldIndex("linguistic_id");
    modelRel->setRelation(typeIndex,QSqlRelation("linguistic_scale","id","simbol"));
    modelRel->select();
    modelRel->setFilter("questionnaire_id = "+currentQuest);
    modelRel->rowCount();

    QSqlRecord r2;
    qDebug() << "rowCount: " <<modelRel->rowCount();
    for (int var = 0; var <modelRel->rowCount() ; ++var) {
        r2 = modelRel->record(var);
        modelRelMap.insert(var+1,r2);
        qDebug() << "id:" << r2.value("id").toInt()
                 << "alt1,alt2"<< r2.value("alt1").toInt()
                 << r2.value("alt2").toInt() << "simbol"<< r2.value("simbol");

    }

    preferences = new QSqlRelationalTableModel(this);
    preferences->setTable("question_linguistic_scale");
    preferences->setEditStrategy(QSqlTableModel::OnManualSubmit);
    typeIndex = preferences->fieldIndex("ling_scale_id");
    preferences->setRelation(typeIndex,QSqlRelation("linguistic_scale","id","simbol"));
    preferences->select();
    preferences->setFilter("quest_id = "+currentQuest);
    QSqlRecord pr;
    qDebug() << "preferences rowCount: " <<preferences->rowCount();
    for (int var = 0; var <preferences->rowCount() ; ++var) {
        pr = preferences->record(var);
        preferencesMap.insert(var+1, pr);
        qDebug() << "pr:" << pr.value("id").toInt() << "simbol"<< pr.value("simbol");

    }



    //get data for preferencies
    questions = new QSqlRelationalTableModel(this);
    questions->setTable("questions");
    questions->setEditStrategy(QSqlTableModel::OnManualSubmit);
    questions->select();
    questions->setFilter("questionnaire = "+currentQuest);
    //;
    QSqlRecord qr;
    qDebug() << "rowCount: " <<questions->rowCount();
    for (int var = 0; var <questions->rowCount() ; ++var) {
        qr = questions->record(var);
        questionsMap.insert(qr.value("id").toInt(),qr);

        qDebug() << "id:" << qr.value("id").toInt()
                 << "description"<< qr.value("description");
    }



    //get data for alternative
    alternative = new QSqlRelationalTableModel(this);
    alternative->setTable("alternative");
    alternative->setEditStrategy(QSqlTableModel::OnManualSubmit);
    alternative->select();
    alternative->setFilter("questionnaire_id = "+currentQuest);
    //;
    QSqlRecord ar;
    qDebug() << "alternative rowCount: " <<alternative->rowCount();
    for (int var = 0; var <alternative->rowCount() ; ++var) {
        ar = alternative->record(var);
        alternativeMap.insert(ar.value("id").toInt(),ar);
        qDebug() << "id:" << ar.value("id").toInt()
                 << "description"<< ar.value("description");
    }



    //get users from db
    users = new QSqlRelationalTableModel(this);
    users->setTable("questionnarie_user");
    users->setEditStrategy(QSqlTableModel::OnManualSubmit);
    users->select();
    users->setFilter("quest_id = "+currentQuest);
    users->setFilter("complete = 1 ");//potrebbero esserci degli utenti che non hanno completato il questionario
    //;
    QSqlRecord ur;
    qDebug() << "users rowCount: " <<users->rowCount();
    for (int var = 0; var <users->rowCount() ; ++var) {
        ur = users->record(var);
        usersMap.insert(var+1,ur);
        qDebug() << "id:" << ur.value("id").toInt()
                 << "description"<< ur.value("user_id").toInt();
    }

    currentUser = 1;


    n = ui->spinBox_Criteria->value();
    m = ui->spinBox_Alternatives->value();
    r = ui->spinBox_Surveyed->value();
    n = questions->rowCount();
    ui->spinBox_Criteria->setValue(n);
    m = alternative->rowCount();
    ui->spinBox_Alternatives->setValue(m);
    r = users->rowCount();
    ui->spinBox_Surveyed->setValue(r);

    //OK

}

void MainWindow::saveGlobalVariables()
{

    n = ui->spinBox_Criteria->value();
    m = ui->spinBox_Alternatives->value();
    r = ui->spinBox_Surveyed->value();

}

//SECTION1
void MainWindow::section1_clicked()
{

    ui->lineEdit->setText("section1_clicked");
    ui->lineEdit->setReadOnly(true);

    ui->spinBox_section1_surveyedNumber->show();
    ui->label_section1_surveyedNumber->show();
    ui->pushButton_section1_toNextSurveyed->show();
    ui->pushButton_section1_saveTheResults->show();

    n = ui->spinBox_Criteria->value();
    m = ui->spinBox_Alternatives->value();
    r = ui->spinBox_Surveyed->value();

    QWidget *central = new QWidget;
    QScrollArea *scroll = ui->scrollArea;
    QVBoxLayout *g = new QVBoxLayout(central);
    scroll->setWidget(central);
    scroll->setWidgetResizable(true);

    QLabel* labelA = new QLabel(tr("Answers:"));
    ui->verticalLayout->addWidget(labelA);
    ui->verticalLayout->setSpacing(0);
    ui->verticalLayout->setMargin(0);
    ui->verticalLayout->setContentsMargins(0,0,0,0);
    //ui->spinBox_answerSurveyed->setMaximum(r);

    QLayoutItem* item;
    while ( ( item = ui->verticalLayout->takeAt( 0 ) ) != NULL )

    {
        delete item->widget();
        delete item;
    }

    m_criteriaRowList.clear();
    for(int i=1; i<=n*(n-1)/2 ; i++)
    {
        //QLabel* label_numAns = new QLabel();
        //label_numAns->setNum(i);
        //ui->verticalLayout->addWidget(label_numAns);
        CriteriaRow* row = new CriteriaRow();
        QSqlRecord record;

        for(int k=1; k<=preferencesMap.size(); k++){
            record = preferencesMap[k];
            if(record.value("user").toInt() == usersMap[currentUser].value("user_id").toInt()){
                foreach(QAbstractButton *button, row->m_criteriaGroup->buttons())
                    if(button->text() == record.value("simbol")){
                        button->setChecked(true);

                    }
            }

        }

        g->addWidget(row);
        //ui->verticalLayout->addWidget(row);
        m_criteriaRowList.append(row);

        //TODO
        //row->m_criteriaGroup->checkedButton()->setChecked(true);


    }


}

void MainWindow::section1_toNext()
{

    currentUser ++;
    counter1=1;

    int surveyed;
    surveyed = ui->spinBox_section1_surveyedNumber->value()+1;
    ui->spinBox_section1_surveyedNumber->setValue(surveyed);

    //repeat function section1Clicked() for all surveyed peoples
    if (counter1 <=r)
    {
        section1_clicked();
    }else{

    }

    counter1++;

    if (ui->spinBox_section1_surveyedNumber->value()  == r)
    {
        ui->pushButton_section1_toNextSurveyed->hide();
        ui->label_section1_endSurveyed->show();
    }

    ui->lineEdit->clear();
    ui->lineEdit->setText("Surveyed:"+QString::number(counter1));
    ui->lineEdit->setReadOnly(true);


}

void MainWindow::section1_saveResults()
{
    ui->fuzzyResultsOnscreen->append("section: section1_saveResults");
    // inquest asezione mi salvo i dati inerenti ai criteria
    QList<QString> resultList;

    std::vector<Eigen::Vector3f> results;

    Eigen::Vector3f fuzzyNo1;
    Eigen::Vector3f fuzzyNo2;
    Eigen::Vector3f fuzzyNo3;
    Eigen::Vector3f fuzzyNo4;
    Eigen::Vector3f fuzzyNo5;
    Eigen::Vector3f fuzzyNo6;
    Eigen::Vector3f fuzzyNo7;


    for(int i = 0; i < n*(n-1)/2; i++)
    {
        CriteriaRow* row = m_criteriaRowList.at(i);
        QString radioText = row->m_criteriaGroup->checkedButton()->text();
        resultList.append(radioText);


        if(radioText == "---")
        {

            fuzzyNo1[0]= (1.0/3.0);
            fuzzyNo1[1]= (2.0/5.0);
            fuzzyNo1[2]= (1.0/2.0);

            results.push_back (fuzzyNo1);
        }

        else if(radioText == "--")
        {
            fuzzyNo2[0]= (2.0/5.0);
            fuzzyNo2[1]= (1.0/2.0);
            fuzzyNo2[2]= (2.0/3.0);

            results.push_back (fuzzyNo2);
        }

        else if(radioText == "-")
        {
            fuzzyNo3[0]= (1.0/2.0);
            fuzzyNo3[1]= (2.0/3.0);
            fuzzyNo3[2]= (1.0);

            results.push_back (fuzzyNo3);
        }

        else if(radioText == "=")
        {
            fuzzyNo4[0]= (2.0/3.0);
            fuzzyNo4[1]= (1.0);
            fuzzyNo4[2]= (3.0/2.0);

            results.push_back (fuzzyNo4);
        }

        else if(radioText == "+")
        {
            fuzzyNo5[0]= (1.0);
            fuzzyNo5[1]= (3.0/2.0);
            fuzzyNo5[2]= (2.0);

            results.push_back (fuzzyNo5);
        }

        else if(radioText == "++")
        {
            fuzzyNo6[0]= (3.0/2.0);
            fuzzyNo6[1]= (2.0);
            fuzzyNo6[2]= (5.0/2.0);

            results.push_back (fuzzyNo6);
        }

        else if(radioText == "+++")
        {
            fuzzyNo7[0]= (2.0);
            fuzzyNo7[1]= (5.0/2.0);
            fuzzyNo7[2]= (3.0);

            results.push_back (fuzzyNo7);
        }

    }

    totalResults1.push_back (results);
    ui->fuzzyResultsOnscreen->setText("- - - - - - - -  totalResults1: " + QString::number( totalResults1.size()));
    std::cout<<"- - - - - - - -  totalResults1: "<<totalResults1.size();
    std::cout<<'\n';

    ui->lineEdit->clear();
    ui->lineEdit->setText("SAVE TotalResults");
    ui->lineEdit->setReadOnly(true);

}

void MainWindow::section1_calculations()
{

    //TODO save the results

    ui->label_section1_endSurveyed->hide();
    ui->label_section1_surveyedNumber->hide();
    ui->spinBox_section1_surveyedNumber->hide();
    ui->pushButton_section1_saveTheResults->hide();
    ui->pushButton_section1_toNextSurveyed->hide();
    ui->fuzzyResultsOnscreen->append(" --------------------------------- n:"+QString::number( n));
    ui->fuzzyResultsOnscreen->append(" --------------------------------- r:"+QString::number( r));
    std::cout<<" --------------------------------- n: "<<n;
    std::cout<<" --------------------------------- r: "<<r;

    for (unsigned i=0; i<totalResults1.size() ; i++)
    {
        totalResults1[i];
        std::cout << '\n';
    }

    std::vector<Eigen::Vector3f> zero;
    std::vector< std::vector<Eigen::Vector3f> > test;

    for (unsigned j=0; j<n*(n-1)/2; j++)

    {
        for (unsigned i=0; i<totalResults1.size() ; i++)
        {
            zero.push_back (totalResults1.at(i).at(j));
        }

        if(zero.size() != totalResults1.size())
        {
            zero.erase (zero.begin(),zero.begin()+r);
            test.push_back(zero);
        }
        else
            test.push_back(zero);

    }

    std::vector<float> sommaxTotale;
    std::vector<float> sommayTotale;
    std::vector<float> sommazTotale;

    std::vector<float> mediaxTotale;
    std::vector<float> mediayTotale;
    std::vector<float> mediazTotale;


    for (unsigned i=0; i<n*(n-1)/2; i++)
    {
        float sommax = 0;
        float sommay = 0;
        float sommaz = 0;

        float mediax = 0;
        float mediay = 0;
        float mediaz = 0;


        for (unsigned j=0; j<totalResults1.size() ; j++)
        {

            sommax=sommax + test.at(i).at(j).x();
            sommay=sommay + test.at(i).at(j).y();
            sommaz=sommaz + test.at(i).at(j).z();

            mediax=sommax/r;
            mediay=sommay/r;
            mediaz=sommaz/r;

        }

        sommaxTotale.push_back (sommax);
        sommayTotale.push_back (sommay);
        sommazTotale.push_back (sommaz);

        mediaxTotale.push_back (mediax);
        mediayTotale.push_back (mediay);
        mediazTotale.push_back (mediaz);

    }


    // vettore dei resultsSurvey:

    std::vector<float> resultSurvey; //vettore di appoggio
    std::vector< std::vector<float> > resultsSurvey;

    for (unsigned i=0; i<n*(n-1)/2; i++)

    {
        ui->fuzzyResultsOnscreen->append(" --------------------------------- r:"+QString::number(mediaxTotale.at(i)));
        std::cout<<mediaxTotale.at(i);
        std::cout << '\n';
        ui->fuzzyResultsOnscreen->append(" --------------------------------- r:"+QString::number(mediayTotale.at(i)));
        std::cout<<mediayTotale.at(i);
        std::cout << '\n';
        ui->fuzzyResultsOnscreen->append(" --------------------------------- r:"+QString::number(mediazTotale.at(i)));
        std::cout<<mediazTotale.at(i);
        std::cout << '\n';

        resultSurvey.push_back(mediaxTotale.at(i));
        resultSurvey.push_back(mediayTotale.at(i));
        resultSurvey.push_back(mediazTotale.at(i));


        if(resultSurvey.size() != 3)
        {
            resultSurvey.erase (resultSurvey.begin(),resultSurvey.begin()+3);
            resultsSurvey.push_back(resultSurvey);
        }
        else
            resultsSurvey.push_back(resultSurvey);
    }

    std::cout << '\n';
    std::cout << " --------------------------------- ";
    std::cout<<" resultsSurvey size: "<<resultsSurvey.size();
    std::cout << '\n';
    ui->fuzzyResultsOnscreen->append(" --------------------------------- r:"+QString::number(resultsSurvey.size()));
    // vettore dei resultsSurveyInv:

    std::vector<float> resultSurveyInv;
    std::vector< std::vector<float> > resultsSurveyInv;


    for (unsigned i=0; i<n*(n-1)/2; i++)

    {
        std::cout<<1/mediazTotale.at(i);
        std::cout << '\n';
        std::cout<<1/mediayTotale.at(i);
        std::cout << '\n';
        std::cout<<1/mediaxTotale.at(i);
        std::cout << '\n';

        resultSurveyInv.push_back(1/mediazTotale.at(i));
        resultSurveyInv.push_back(1/mediayTotale.at(i));
        resultSurveyInv.push_back(1/mediaxTotale.at(i));


        if(resultSurveyInv.size() != 3)
        {
            resultSurveyInv.erase (resultSurveyInv.begin(),resultSurveyInv.begin()+3);
            resultsSurveyInv.push_back(resultSurveyInv);
        }
        else
            resultsSurveyInv.push_back(resultSurveyInv);
    }
    std::cout << '\n';
    std::cout << " --------------------------------- ";
    std::cout<<" resultsSurveyInv size: "<<resultsSurveyInv.size();
    std::cout << '\n';


    // Pair Wise comparison matrix _ GENERAL ALGORITHM

    std::vector<float> identity(3,1.0);
    //std::vector<float> two(3,2.0);
    std::vector< std::vector<float> > rowComparison;
    std::vector< std::vector< std::vector<float> > > Comparison;

    for (unsigned i=0; i<n; i++)
    {
        for (unsigned j=0; j<n; j++)
        {


            if (j==i)       {
                rowComparison.push_back(identity);
            }
            else if (j>i)   {
                rowComparison.push_back(resultsSurvey.at(j-1+i*(i-1)/2+i*(n-i-1)));
            }
            else if (j<i)   {
                rowComparison.push_back(resultsSurveyInv.at(j+i*(i-1)/2));
            }
        }



        if(rowComparison.size() != n)
        {
            rowComparison.erase (rowComparison.begin(),rowComparison.begin()+n);
            Comparison.push_back(rowComparison);
        }
        else
            Comparison.push_back(rowComparison);
    }
    std::cout << '\n';
    std::cout << " --------------------------------- ";
    std::cout<<" Comparison size: "<<Comparison.size();
    std::cout << '\n';


    Eigen::Vector3f Sum;
    Sum.x() = 0;
    Sum.y() = 0;
    Sum.z() = 0;


    for (unsigned i=0; i<n; i++)
    {
        for (unsigned j=0; j<n; j++)
        {
            Sum.x() += Comparison.at(i).at(j).at(2);
            Sum.y() += Comparison.at(i).at(j).at(1);
            Sum.z() += Comparison.at(i).at(j).at(0);
        }
    }

    std::cout<<"---------------------------------------- eigen Sum ---------------------------------------";
    std::cout << '\n';
    std::cout<<"Sum0 : "<<Sum.x();
    std::cout << '\n';
    std::cout<<"Sum1 : "<<Sum.y();
    std::cout << '\n';
    std::cout<<"Sum2 : "<<Sum.z();
    std::cout << '\n';

    Eigen::Vector3f SumInv;
    SumInv.x() = 1/Sum.x();
    SumInv.y() = 1/Sum.y();
    SumInv.z() = 1/Sum.z();

    std::cout<<"---------------------------------------- eigen sumInv ---------------------------------------";
    std::cout << '\n';
    std::cout<<"SumInv0 : "<<SumInv.x();
    std::cout << '\n';
    std::cout<<"SumInv1 : "<<SumInv.y();
    std::cout << '\n';
    std::cout<<"SumInv2 : "<<SumInv.z();
    std::cout << '\n';



    Eigen::Vector3f Cappoggio;
    std::vector<Eigen::Vector3f> C;
    Eigen::Vector3f Sappoggio;
    std::vector<Eigen::Vector3f> S;



    for (unsigned i=0; i<n; i++)
    {
        Cappoggio.x() = 0;
        Cappoggio.y() = 0;
        Cappoggio.z() = 0;

        for (unsigned j=0; j<n; j++)
        {
            Cappoggio.x() += Comparison.at(i).at(j).at(0);
            Sappoggio.x() = Cappoggio.x()*SumInv.x();

            Cappoggio.y() += Comparison.at(i).at(j).at(1);
            Sappoggio.y() = Cappoggio.y()*SumInv.y();

            Cappoggio.z() += Comparison.at(i).at(j).at(2);
            Sappoggio.z() = Cappoggio.z()*SumInv.z();
        }
        C.push_back(Cappoggio);
        S.push_back(Sappoggio);
    }

    std::cout << '\n';
    std::cout << " --------------------------------- ";
    std::cout<<" S size: "<<S.size();
    std::cout << '\n';



    float Vappoggio;
    std::vector<float> Vapp;
    std::vector< std::vector<float> > V;

    for (unsigned i=0; i<n; i++)
    {
        Vapp.erase(Vapp.begin(),Vapp.end());

        for (unsigned j=0; j<n; j++)
        {
            Vappoggio = 0;

            if (j==i)
            {
            }
            else
            {
                if (S.at(i).y()>S.at(j).y())
                {
                    Vappoggio = 1;
                }
                else
                {
                    Vappoggio = (S.at(j).x() - S.at(i).z())/((S.at(i).y()-S.at(i).z())-(S.at(j).y()-S.at(j).x()));
                }

                std::cout << '\n';
                std::cout<<Vappoggio;
                std::cout << '\n';

                Vapp.push_back(Vappoggio);

            }
        }
        V.push_back(Vapp);

    }
    std::cout << '\n';
    std::cout << " -------------------------------- ";
    std::cout<<" V size : "<<V.size();
    std::cout << '\n';

    float min;
    std::vector<float> d;

    for (unsigned i=0; i<n; i++)
    {
        for (unsigned j=0; j<V.at(0).size(); j++)
        {
            min = 1;
            if (V.at(i).at(j) < min)
            {
                min = V.at(i).at(j);
            }
            std::cout << '\n';
            std::cout<<"min: "<<min;
            std::cout << '\n';
        }
        d.push_back(min);
    }
    std::cout << " ------------------------------------- ";
    std::cout<<"d size: ______ "<<d.size();
    std::cout << '\n';


    float sumN;



    sumN = 0;

    for (unsigned i=0; i<n; i++)
    {
        sumN += d.at(i);
    }

    std::cout << '\n';
    ui->fuzzyResultsOnscreen->append("sumN: "+QString::number(sumN));
    std::cout<<"sumN: "<<sumN;
    std::cout << '\n';

    for (unsigned j=0; j<n; j++)
    {
        wS1Appoggio = d.at(j)/sumN;
        ui->fuzzyResultsOnscreen->append("wS1Appoggio: "+QString::number(wS1Appoggio));

        std::cout<<"wS1Appoggio: "<<wS1Appoggio;
        std::cout << '\n';

        wS1.push_back(wS1Appoggio);

    }


    std::cout << '\n';
    ui->fuzzyResultsOnscreen->append("wS1 size: ______  "+QString::number(wS1.size()));
    std::cout<<"wS1 size: ______ "<<wS1.size();
    std::cout << '\n';



    //insert data in db
    QDateTime now = QDateTime::currentDateTime();
    qDebug() << "Insert data into resultspreferences";
    QSqlQuery qry;

    for (int i=0; i<n; i++)
    {
        ui->fuzzyResultsOnscreen->append("w -iesimo : "+QString::number(wS1.at(i)));
        std::cout<<"w -iesimo : "<<wS1.at(i);
        std::cout << '\n';


        qry.prepare("INSERT INTO resultspreferences(quest_id,date,criteria,value)"
                    "VALUES(:quest_id,:date,:criteria,:value)");

        qry.bindValue(":quest_id",currentQuest.toInt());
        qry.bindValue(":date",now);
        qry.bindValue(":criteria",i);
        qry.bindValue(":value",wS1.at(i));

        if( !qry.exec() )
            qDebug() << qry.lastError().text();
        else
            qDebug( "Inserted!" );


    }








}

//SECTION2
void MainWindow::section2_clicked()
{

    ui->lineEdit->clear();
    ui->lineEdit->setText("section: section2");
    ui->lineEdit->setReadOnly(true);
    qDebug() <<"section: section2_clicked";

    ui->spinBox_section2_surveyedNumber->show();
    ui->label_section2_surveyedNumber->show();
    ui->spinBox_section2_criterionNumber->show();
    ui->label_section2_criterionNumber->show();

    ui->pushButton_section2_saveTheResults->show();
    ui->pushButton_section2_toNextCriterion->show();
    ui->pushButton_section2_toNextSurveyed->show();

    n = ui->spinBox_Criteria->value();
    m = ui->spinBox_Alternatives->value();
    r = ui->spinBox_Surveyed->value();

    qDebug() <<"n"<<n<<"m"<<m<<"r"<<r;

    QLabel* labelA = new QLabel(tr("Answers:"));
    ui->verticalLayout->addWidget(labelA);

    QWidget *central = new QWidget;
    QScrollArea *scroll = ui->scrollArea;
    QVBoxLayout *g = new QVBoxLayout(central);
    scroll->setWidget(central);
    scroll->setWidgetResizable(true);

    QLayoutItem* item;
    while ( ( item = ui->verticalLayout->takeAt( 0 ) ) != NULL )

    {
        delete item->widget();
        delete item;
    }

    m_criteriaRowList.clear();

    qDebug() <<"righe: "<< m*(m-1)/2;

    for(int i=1; i<=m*(m-1)/2 ; i++)
    {
        CriteriaRow* row = new CriteriaRow();

        QSqlRecord record;
        for(int k=1; k<=modelRelMap.size(); k++){
            record = modelRelMap[k];
            if(record.value("user_id").toInt() == usersMap[currentUser].value("user_id").toInt()){
                foreach(QAbstractButton *button, row->m_criteriaGroup->buttons())
                    if(button->text() == record.value("simbol"))
                        button->setChecked(true);
            }

        }

        g->addWidget(row);
        //ui->verticalLayout->addWidget(row);
        m_criteriaRowList.append(row);
    }


    qDebug() <<"Section END";

}

void MainWindow::section2_toNextCriterion()
{

    counter2_criterion=1;
    ui->lineEdit->clear();
    ui->lineEdit->setText("section: section2, criteria:"+QString::number(counter2_criterion));
    ui->lineEdit->setReadOnly(true);
    int criterion;
    criterion = ui->spinBox_section2_criterionNumber->value()+1;
    ui->spinBox_section2_criterionNumber->setValue(criterion);

    //repeat function section1Clicked() for all surveyed peoples
    if (counter2_criterion <=n)
    {
        section2_clicked();
    }

    counter2_criterion++;


    if (ui->spinBox_section2_criterionNumber->value()  == n)
    {
        //ui->pushButton_section2_toNextCriterion->hide();
        ui->pushButton_section2_toNextSurveyed->show();
        //ui->label_section2_endCriterion->show();
    }
}


void MainWindow::section2_toNextSurveyed()
{


    ui->spinBox_section2_criterionNumber->setValue(1);
    counter2_surveyed=1;
    ui->lineEdit->clear();
    ui->lineEdit->setText("section: section2, criteria:"+QString::number(counter2_criterion)+"surveyed:"+QString::number(counter2_surveyed));
    ui->lineEdit->setReadOnly(true);
    int surveyed;
    surveyed = ui->spinBox_section2_surveyedNumber->value()+1;
    ui->spinBox_section2_surveyedNumber->setValue(surveyed);

    //repeat function section1Clicked() for all surveyed peoples
    if (counter2_surveyed <=r)
    {
        section2_clicked();
    }

    counter2_surveyed++;


    if (ui->spinBox_section2_surveyedNumber->value()  == r)
    {
        //ui->pushButton_section2_toNextSurveyed->hide();
        ui->pushButton_section2_toNextCriterion->show();
        //ui->label_section2_endSurveyed->show();
    }

}


void MainWindow::section2_saveResults()
{
    QList<QString> resultList;

    results2.erase(results2.begin(),results2.end());

    Eigen::Vector3f fuzzyNo1;
    Eigen::Vector3f fuzzyNo2;
    Eigen::Vector3f fuzzyNo3;
    Eigen::Vector3f fuzzyNo4;
    Eigen::Vector3f fuzzyNo5;
    Eigen::Vector3f fuzzyNo6;
    Eigen::Vector3f fuzzyNo7;


    for(int i = 0; i < m*(m-1)/2; i++)
    {
        CriteriaRow* row = m_criteriaRowList.at(i);
        QString radioText = row->m_criteriaGroup->checkedButton()->text();
        resultList.append(radioText);

        if(radioText == "---")
        {

            fuzzyNo1[0]= (1.0/3.0);
            fuzzyNo1[1]= (2.0/5.0);
            fuzzyNo1[2]= (1.0/2.0);

            results2.push_back (fuzzyNo1);
        }

        else if(radioText == "--")
        {
            fuzzyNo2[0]= (2.0/5.0);
            fuzzyNo2[1]= (1.0/2.0);
            fuzzyNo2[2]= (2.0/3.0);

            results2.push_back (fuzzyNo2);
        }

        else if(radioText == "-")
        {
            fuzzyNo3[0]= (1.0/2.0);
            fuzzyNo3[1]= (2.0/3.0);
            fuzzyNo3[2]= (1.0);

            results2.push_back (fuzzyNo3);
        }

        else if(radioText == "=")
        {
            fuzzyNo4[0]= (2.0/3.0);
            fuzzyNo4[1]= (1.0);
            fuzzyNo4[2]= (3.0/2.0);

            results2.push_back (fuzzyNo4);
        }

        else if(radioText == "+")
        {
            fuzzyNo5[0]= (1.0);
            fuzzyNo5[1]= (3.0/2.0);
            fuzzyNo5[2]= (2.0);

            results2.push_back (fuzzyNo5);
        }

        else if(radioText == "++")
        {
            fuzzyNo6[0]= (3.0/2.0);
            fuzzyNo6[1]= (2.0);
            fuzzyNo6[2]= (5.0/2.0);

            results2.push_back (fuzzyNo6);
        }

        else if(radioText == "+++")
        {
            fuzzyNo7[0]= (2.0);
            fuzzyNo7[1]= (5.0/2.0);
            fuzzyNo7[2]= (3.0);

            results2.push_back (fuzzyNo7);
        }

    }
    totalResults2.push_back(results2);

    std::cout<<"- - - - - - - -  results2: "<<results2.size();
    std::cout<<'\n';
    std::cout<<"- - - - - - - -  totalResults2: "<<totalResults2.size();
    std::cout<<'\n';

}


void MainWindow::section2_calculations()
{
    std::cout<<"%%%%%%%%%%%%%%%%%%%%%%%%%%   CALCULATIONS   %%%%%%%%%%%%%%%%%%%%%%%%%%";
    std::cout<<'\n';
    std::cout<<"%%%%%%%%%%%%%%%%%%%%%%%%%%   totalResults2";
    std::cout<<'\n';
    std::cout<<"- - - - - - - -  totalResults2 size: "<<totalResults2.size();
    std::cout<<'\n';

    for (unsigned i=0; i<totalResults2.size() ; i++)
    {
        std::cout<<"- - - - - - - -  totalResults2.at("<<i<<") size: "<<totalResults2.at(i).size();
        std::cout<<'\n';
    }
    std::cout<<"%%%%%%%%%%%%%%%%%%%%%%%%%%   ";
    std::cout<<'\n';


    std::vector< std::vector< Eigen::Vector3f> > stani;

    std::vector< std::vector< std::vector<Eigen::Vector3f> > > superstani;

    for (int i=0; i<r ; i++)
    {
        stani.erase(stani.begin(),stani.end());

        for (int j=0; j<n ; j++)
        {
            stani.push_back(totalResults2.at(j+n*i));

        }
        superstani.push_back(stani);
    }

    std::cout<<'\n';
    std::cout<<"%%%%%%%%%%%%%%%%%%%%%%%%%%   totalResults2 -> superstani ";
    std::cout<<'\n';
    std::cout<<"- - - - - - - -  stani: "<<stani.size();
    std::cout<<'\n';
    std::cout<<"- - - - - - - -  superstani: "<<superstani.size();
    std::cout<<'\n';

    for (unsigned i=0; i<superstani.size() ; i++)
    {
        std::cout<<'\n';
        std::cout<<"- - - - - - - -  superstani.at("<<i<<"): "<<superstani.at(i).size();
        std::cout<<'\n';
    }

    for (unsigned i=0; i<r ; i++)
    {
        for (unsigned j=0; j<n ; j++)
        {
            std::cout<<'\n';
            std::cout<<"- - - - - - - -  superstani.at("<<i<<").at("<<j<<"): "<<superstani.at(i).at(j).size();
            std::cout<<'\n';
        }
    }

    for (unsigned k=0; k<r; k++) //surveyed
    {
        for (unsigned i=0; i<n; i++) //criteria
        {
            for (unsigned j=0; j<(m*(m-1)/2); j++) //answers
            {
                std::cout << '\n';
                std::cout << " ---------------------------------------------------------------- ";
                std::cout << '\n';
                std::cout<<"superstani.at("<<k<<").at("<<i<<").at("<<j<<")  : "<<superstani.at(k).at(i).at(j).x()<<"  "<<superstani.at(k).at(i).at(j).y()<<"  "<<superstani.at(k).at(i).at(j).z();
                std::cout << '\n';
                std::cout << " ---------------------------------------------------------------- ";
                std::cout << '\n';

            }
        }
    }


    std::cout<<"%%%%%%%%%%%%%%%%%%%%%%%%%%   ";
    std::cout<<'\n';


    Eigen::Vector3f somma;
    somma.x() = 0;
    somma.y() = 0;
    somma.z() = 0;
    Eigen::Vector3f media;
    media.x() = 0;
    media.y() = 0;
    media.z() = 0;
    Eigen::Vector3f mediaInv;
    mediaInv.x() = 0;
    mediaInv.y() = 0;
    mediaInv.z() = 0;


    std::vector<Eigen::Vector3f> resultsSurvey;
    std::vector< std::vector<Eigen::Vector3f> > rS;

    std::vector<Eigen::Vector3f> resultsSurveyInv;
    std::vector< std::vector<Eigen::Vector3f> > rSInv;

    //metto prima criteria e poi surveyed perchè devo costruire n matrici pair-wise comparison

    for (unsigned j=0; j<n ; j++)  //criteria n
    {
        resultsSurvey.erase(resultsSurvey.begin(),resultsSurvey.end());
        resultsSurveyInv.erase(resultsSurveyInv.begin(),resultsSurveyInv.end());

        media.x() = 0;
        media.y() = 0;
        media.z() = 0;

        mediaInv.x() = 0;
        mediaInv.y() = 0;
        mediaInv.z() = 0;

        for (unsigned k=0; k<m*(m-1)/2 ; k++) //answer on alternatives: m*(m-1)/2
        {
            somma.x() = 0;
            somma.y() = 0;
            somma.z() = 0;

            for (unsigned i=0; i<r; i++) //surveyed
            {
                somma.x() += superstani.at(i).at(j).at(k).x();
                somma.y() += superstani.at(i).at(j).at(k).y();
                somma.z() += superstani.at(i).at(j).at(k).z();
            }

            media.x() = somma.x()/r;
            media.y() = somma.y()/r;
            media.z() = somma.z()/r;

            mediaInv.x() = 1/(media.z());
            mediaInv.y() = 1/(media.y());
            mediaInv.z() = 1/(media.x());

            resultsSurvey.push_back(media);
            resultsSurveyInv.push_back(mediaInv);

        }
        rS.push_back(resultsSurvey);
        rSInv.push_back(resultsSurveyInv);

    }

    std::cout<<'\n';
    std::cout<<"%%%%%%%%%%%%%%%%%%%%%%%%%%   rS, rSInv ";
    std::cout<<'\n';
    std::cout<<"-------------------------------------------------";
    std::cout<<'\n';
    std::cout<<"- - - - - - - -  resultsSurvey size : "<<resultsSurvey.size();
    std::cout<<'\n';
    std::cout<<"- - - - - - - -  rS size : "<<rS.size();//3 deve essere
    std::cout<<'\n';
    std::cout<<"- - - - - - - -  rS.at(0) size : "<<rS.at(0).size(); //15 deve essere
    std::cout<<'\n';
    std::cout<<"- - - - - - - -  resultsSurveyInv size : "<<resultsSurveyInv.size();
    std::cout<<'\n';
    std::cout<<"- - - - - - - -  rSInv size : "<<rSInv.size();//3 deve essere
    std::cout<<'\n';
    std::cout<<"- - - - - - - -  rSInv.at(0) size : "<<rSInv.at(0).size(); //15 deve essere
    std::cout<<'\n';
    std::cout<<"-------------------------------------------------";
    std::cout<<'\n';

    for (unsigned k=0; k<n; k++)
    {

        for (unsigned i=0; i<m*(m-1)/2; i++)
        {

            std::cout << " --------------------------------- ";
            std::cout << '\n';
            std::cout<<"rS.at("<<k<<").at("<<i<<").x: "<<rS.at(k).at(i).x();
            std::cout << '\n';
            std::cout<<"rS.at("<<k<<").at("<<i<<").y: "<<rS.at(k).at(i).y();
            std::cout << '\n';
            std::cout<<"rS.at("<<k<<").at("<<i<<").z: "<<rS.at(k).at(i).z();
            std::cout << '\n';
            std::cout << " --------------------------------- ";

        }
    }
    for (unsigned k=0; k<n; k++)
    {
        for (unsigned i=0; i<m*(m-1)/2; i++)
        {

            std::cout << " --------------------------------- ";
            std::cout << '\n';
            std::cout<<"rSInv.at("<<k<<").at("<<i<<").x: "<<rSInv.at(k).at(i).x();
            std::cout << '\n';
            std::cout<<"rSInv.at("<<k<<").at("<<i<<").y: "<<rSInv.at(k).at(i).y();
            std::cout << '\n';
            std::cout<<"rSInv.at("<<k<<").at("<<i<<").z: "<<rSInv.at(k).at(i).z();
            std::cout << '\n';
            std::cout << " --------------------------------- ";

        }
    }
    std::cout<<"%%%%%%%%%%%%%%%%%%%%%%%%%%   ";
    std::cout<<'\n';


    // Pair Wise comparison matrix _ GENERAL ALGORITHM

    Eigen::Vector3f identity;
    identity.x() = 1;
    identity.y() = 1;
    identity.z() = 1;

    std::vector<Eigen::Vector3f> rowComparison;
    std::vector< std::vector< Eigen::Vector3f> > Comparison;
    std::vector< std::vector< std::vector<Eigen::Vector3f> > > ComparisonTotal;


    for (unsigned k=0; k<n; k++)
    {
        for (unsigned i=0; i<m; i++)
        {
            //Comparison.erase(Comparison.begin(),Comparison.end());

            for (unsigned j=0; j<m; j++)
            {
                //rowComparison.erase(rowComparison.begin(),rowComparison.end());

                if (j==i)       {
                    rowComparison.push_back(identity);
                }
                else if (j>i)   {
                    rowComparison.push_back(rS.at(k).at(j-1+i*(i-1)/2+i*(m-i-1)));
                }
                else if (j<i)   {
                    rowComparison.push_back(rSInv.at(k).at(i-1+j*(j-1)/2+j*(m-j-1)));
                }
            }

            if(rowComparison.size() != m)
            {
                rowComparison.erase (rowComparison.begin(),rowComparison.begin()+m);
                Comparison.push_back(rowComparison);
            }
            else
                Comparison.push_back(rowComparison);
        }

        if(Comparison.size() != m)
        {
            Comparison.erase (Comparison.begin(),Comparison.begin()+m);
            ComparisonTotal.push_back(Comparison);
        }
        else
            ComparisonTotal.push_back(Comparison);

    }

    std::cout<<'\n';
    std::cout<<"%%%%%%%%%%%%%%%%%%%%%%%%%%  ComparisonTotal ";
    std::cout << '\n';
    std::cout << " --------------------------------- ";
    std::cout << '\n';
    //std::cout<<" Comparison size: "<<Comparison.size();
    std::cout << '\n';
    std::cout<<" ComparisonTotal size: "<<ComparisonTotal.size();
    std::cout << '\n';
    std::cout<<" ComparisonTotal.at(1) size: "<<ComparisonTotal.at(1).size();
    std::cout << '\n';
    std::cout<<" ComparisonTotal.at(1).at(0) size: "<<ComparisonTotal.at(1).at(0).size();
    std::cout << '\n';
    std::cout<<" ComparisonTotal.at(1).at(0).at(0) size: "<<ComparisonTotal.at(1).at(0).at(0).size();
    std::cout << '\n';


    /*
for (unsigned k=0; k<r; k++)
{
    for (unsigned i=0; i<m; i++)
    {
        for (unsigned j=0; j<m; j++)
        {
            std::cout << '\n';
            std::cout << " ---------------------------------------------------------------- ";
            std::cout << '\n';
            std::cout<<"ComparisonTotal.at("<<k<<").at("<<i<<").at("<<j<<")  : "<<ComparisonTotal.at(k).at(i).at(j).x()<<"  "<<ComparisonTotal.at(k).at(i).at(j).y()<<"  "<<ComparisonTotal.at(k).at(i).at(j).z();
            std::cout << '\n';
            std::cout << " ---------------------------------------------------------------- ";
            std::cout << '\n';

        }
    }
}
*/

    std::cout<<"%%%%%%%%%%%%%%%%%%%%%%%%%%   ";
    std::cout<<'\n';


    Eigen::Vector3f Sum;
    Sum.x() = 0;
    Sum.y() = 0;
    Sum.z() = 0;
    std::vector<Eigen::Vector3f> SumTotal;

    Eigen::Vector3f SumInv;
    SumInv.x() = 0;
    SumInv.y() = 0;
    SumInv.z() = 0;
    std::vector<Eigen::Vector3f> SumInvTotal;

    for (unsigned k=0; k<n; k++)
    {
        Sum.x() = 0;
        Sum.y() = 0;
        Sum.z() = 0;

        SumInv.x() = 0;
        SumInv.y() = 0;
        SumInv.z() = 0;

        for (unsigned i=0; i<m; i++)
        {
            for (unsigned j=0; j<m; j++)
            {
                Sum.x() += ComparisonTotal.at(k).at(i).at(j).z();
                Sum.y() += ComparisonTotal.at(k).at(i).at(j).y();
                Sum.z() += ComparisonTotal.at(k).at(i).at(j).x();
            }
        }

        SumInv.x() = 1/(Sum.x());
        SumInv.y() = 1/(Sum.y());
        SumInv.z() = 1/(Sum.z());

        SumTotal.push_back(Sum);

        SumInvTotal.push_back(SumInv);

    }


    std::cout<<'\n';
    std::cout<<"%%%%%%%%%%%%%%%%%%%%%%%%%%   S : ";
    std::cout<<'\n';
    std::cout << " --------------------------------- ";
    std::cout << '\n';
    std::cout<<" SumTotal size: "<<SumTotal.size();
    std::cout << '\n';

    for (unsigned k=0; k<n; k++)
    {
        std::cout<<" SumTotal.at("<<k<<") x: "<<SumTotal.at(k).x();
        std::cout << '\n';
        std::cout<<" SumTotal.at("<<k<<") y: "<<SumTotal.at(k).y();
        std::cout << '\n';
        std::cout<<" SumTotal.at("<<k<<") z: "<<SumTotal.at(k).z();
        std::cout << '\n';
    }

    std::cout << " --------------------------------- ";
    std::cout << '\n';
    std::cout<<" SumInvTotal size: "<<SumInvTotal.size();
    std::cout << '\n';

    for (unsigned k=0; k<n; k++)
    {
        std::cout << '\n';
        std::cout << " --------------------------------- ";
        std::cout << '\n';
        std::cout<<" SumInvTotal.at("<<k<<") x: "<<SumInvTotal.at(k).x();
        std::cout << '\n';
        std::cout<<" SumInvTotal.at("<<k<<") y: "<<SumInvTotal.at(k).y();
        std::cout << '\n';
        std::cout<<" SumInvTotal.at("<<k<<") z: "<<SumInvTotal.at(k).z();
        std::cout << '\n';
        std::cout << " --------------------------------- ";
        std::cout << '\n';

    }



    Eigen::Vector3f Cappoggio;
    std::vector<Eigen::Vector3f> C;
    std::vector< std::vector<Eigen::Vector3f> > CTotal;

    Eigen::Vector3f Sappoggio;
    std::vector<Eigen::Vector3f> S;
    std::vector< std::vector<Eigen::Vector3f> > STotal;

    for (unsigned k=0; k<n; k++)
    {
        C.erase(C.begin(),C.end()); //forse va in qll piu interno
        S.erase(S.begin(),S.end());

        for (unsigned i=0; i<m; i++)
        {
            Cappoggio.x() = 0; //forse va in qll piu interno
            Cappoggio.y() = 0;
            Cappoggio.z() = 0;

            Sappoggio.x() = 0;
            Sappoggio.y() = 0;
            Sappoggio.z() = 0;

            for (unsigned j=0; j<m; j++)
            {
                Cappoggio.x() += ComparisonTotal.at(k).at(i).at(j).x();
                Sappoggio.x() = Cappoggio.x()*SumInvTotal.at(k).x();

                Cappoggio.y() += ComparisonTotal.at(k).at(i).at(j).y();
                Sappoggio.y() = Cappoggio.y()*SumInvTotal.at(k).y();

                Cappoggio.z() += ComparisonTotal.at(k).at(i).at(j).z();
                Sappoggio.z() = Cappoggio.z()*SumInvTotal.at(k).z();
            }

            C.push_back(Cappoggio); //forse questo va dentro il ciclo + interno
            S.push_back(Sappoggio);

        }

        CTotal.push_back(C);
        STotal.push_back(S);
    }




    std::cout << '\n';
    std::cout << " --------------------------------- ";
    std::cout<<" S size: "<<S.size();
    std::cout << '\n';
    std::cout<<" STotal size: "<<STotal.size();
    std::cout << '\n';
    std::cout << " --------------------------------- ";

    for (unsigned i=0; i<n; i++)
    {
        for (unsigned j=0; j<m; j++)
        {
            std::cout << '\n';
            std::cout << " --------------------------------- ";
            std::cout << '\n';
            std::cout<<" CTotal("<<i<<")("<<j<<")x "<<CTotal.at(i).at(j).x();
            std::cout << '\n';
            std::cout<<" CTotal("<<i<<")("<<j<<")y "<<CTotal.at(i).at(j).y();
            std::cout << '\n';
            std::cout<<" CTotal("<<i<<")("<<j<<")z "<<CTotal.at(i).at(j).z();
            std::cout << '\n';
            std::cout << " --------------------------------- ";

        }
    }

    for (unsigned i=0; i<n; i++)
    {
        for (unsigned j=0; j<m; j++)
        {
            std::cout << '\n';
            std::cout << " --------------------------------- ";
            std::cout << '\n';
            std::cout<<" STotal("<<i<<")("<<j<<")x "<<STotal.at(i).at(j).x();
            std::cout << '\n';
            std::cout<<" STotal("<<i<<")("<<j<<")y "<<STotal.at(i).at(j).y();
            std::cout << '\n';
            std::cout<<" STotal("<<i<<")("<<j<<")z "<<STotal.at(i).at(j).z();
            std::cout << '\n';
            std::cout << " --------------------------------- ";

        }
    }

    std::cout << '\n';
    std::cout<<"%%%%%%%%%%%%%%%%%%%%%%%%%%   ";



    float Vappoggio;
    std::vector<float> Vapp;
    std::vector< std::vector<float> > V;
    std::vector< std::vector< std::vector<float> > > VTotal;

    for (unsigned k=0; k<n; k++)
    {
        V.erase(V.begin(),V.end());

        for (unsigned i=0; i<m; i++)
        {
            Vapp.erase(Vapp.begin(),Vapp.end());

            for (unsigned j=0; j<m; j++)
            {
                Vappoggio = 0;

                if (j==i)
                {
                }
                else
                {
                    if (STotal.at(k).at(i).y()>STotal.at(k).at(j).y())
                    {
                        Vappoggio = 1;
                    }
                    else
                    {
                        Vappoggio = (STotal.at(k).at(j).x() - STotal.at(k).at(i).z())/((STotal.at(k).at(i).y()-STotal.at(k).at(i).z())-(STotal.at(k).at(j).y()-STotal.at(k).at(j).x()));
                    }

                    std::cout << '\n';
                    std::cout<<Vappoggio;
                    std::cout << '\n';

                    Vapp.push_back(Vappoggio);

                }
            }

            V.push_back(Vapp);
        }
        VTotal.push_back(V);
    }

    std::cout << '\n';
    std::cout<<"%%%%%%%%%%%%%%%%%%%%%%%%%%   V : ";
    std::cout << '\n';
    std::cout << " -------------------------------- ";
    std::cout<<" V size : "<<V.size();
    std::cout << '\n';
    std::cout<<" VTotal size : "<<VTotal.size();
    std::cout << '\n';
    std::cout<<" VTotal.at(0) size : "<<VTotal.at(0).size();
    std::cout << '\n';
    std::cout<<" VTotal.at(0).at(0) size : "<<VTotal.at(0).at(0).size();
    std::cout << '\n';
    std::cout << " -------------------------------- ";
    std::cout << '\n';


    float min;
    std::vector<float> d;
    std::vector< std::vector<float> > dTotal;

    for (unsigned k=0; k<n; k++)
    {
        d.erase(d.begin(),d.end());

        for (unsigned i=0; i<m; i++)
        {
            min = 1;

            for (unsigned j=0; j<VTotal.at(0).at(0).size(); j++)
            {

                if (VTotal.at(k).at(i).at(j) < min)
                {
                    min = VTotal.at(k).at(i).at(j);
                }
                std::cout << '\n';
                std::cout<<"min: "<<min;
                std::cout << '\n';
            }

            d.push_back(min);
        }

        dTotal.push_back(d);
    }


    std::cout << " ------------------------------------- ";
    std::cout << '\n';
    std::cout<<"dTotal size: ______ "<<dTotal.size();
    std::cout << '\n';
    std::cout<<"dTotal.at(0) size: ______ "<<dTotal.at(0).size();
    std::cout << '\n';
    std::cout << " ------------------------------------- ";
    std::cout << '\n';


    for (unsigned i=0; i<n; i++)
    {
        for (unsigned j=0; j<m; j++)
        {
            std::cout << " ------------------------------------- ";
            std::cout << '\n';
            std::cout<<"dTotal("<<i<<")("<<j<<")"<<dTotal.at(i).at(j);
            std::cout << '\n';
            std::cout << " ------------------------------------- ";
            std::cout << '\n';

        }
    }


    float sumN;
    std::vector<float> sumNTotal;




    sumN = 0;


    for (unsigned k=0; k<n; k++)
    {

        sumN = 0;

        for (unsigned i=0; i<m; i++)
        {
            sumN += dTotal.at(k).at(i);
        }

        sumNTotal.push_back(sumN);
    }

    std::cout << "------------------------------";
    std::cout << '\n';
    std::cout<<"sumNTotale size: "<<sumNTotal.size();
    std::cout << '\n';



    for (unsigned i=0; i<n; i++)
    {
        std::cout << " ------------------------------------- ";
        std::cout << '\n';
        std::cout<<"sumNTotal.at("<<i<<")"<<sumNTotal.at(i);
        std::cout << '\n';
        std::cout << " ------------------------------------- ";
        std::cout << '\n';

    }


    for (unsigned k=0; k<n; k++)
    {
        wS2.erase(wS2.begin(),wS2.end());

        for (unsigned i=0; i<m; i++)
        {

            wS2Appoggio = (dTotal.at(k).at(i))/sumNTotal.at(k);

            std::cout<<"wS2Appoggio: "<<wS2Appoggio;
            std::cout << '\n';

            wS2.push_back(wS2Appoggio);

        }

        wS2Total.push_back(wS2);
    }



    std::cout << "------------------------------";
    std::cout << '\n';
    std::cout<<" wS2Totale size: "<<wS2Total.size();
    std::cout << '\n';

    QDateTime now = QDateTime::currentDateTime();
    qDebug() << "Insert data into db";
    QSqlQuery qry;
    for (unsigned i=0; i<n; i++)
    {
        for (unsigned j=0; j<m; j++)
        {
            std::cout << " ------------------------------------- ";
            std::cout << '\n';
            std::cout<<"wS2Total("<<i<<")("<<j<<")"<<wS2Total.at(i).at(j);
            std::cout << '\n';
            std::cout << " ------------------------------------- ";
            std::cout << '\n';

            //insert data in db
            qry.prepare("INSERT INTO results(quest_id,date, criteria, alternative, value)"
                        "VALUES(:quest_id,:date,:criteria,:alternative,:value)");

            qry.bindValue(":quest_id",currentQuest.toInt());
            qry.bindValue(":date",now);
            qry.bindValue(":criteria",i);
            qry.bindValue(":alternative",j);
            qry.bindValue(":value",wS2Total.at(i).at(j));

            if( !qry.exec() )
                qDebug() << qry.lastError().text();
            else
                qDebug( "Inserted!" );


        }
    }




}
