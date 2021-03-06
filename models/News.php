<?php

class News {
/**
* Return single news item with specified id
* @param integer $id
*/

	public static function getNewsItemById($id) {

		$db = DataBase::getConnection();

		$newsList = array();

		$result = $db->query('SELECT * FROM news WHERE id=' . $id);

		//$result->setFetchMode(PDO::FETCH_NUM); //Индексы в виде номеров коллонок
		$result->setFetchMode(PDO::FETCH_ASSOC); //Индексы в виде названия коллонок

		$newsItem = $result->fetch();

		return $newsItem;
	}

	/**
	*Return an array of news items
	*/

	public static function getNewsList() {
		
		$db = DataBase::getConnection();

		$newsList = array();

		$result = $db->query('SELECT id, title, date, short_content FROM news ORDER BY date DESC LIMIT 10');

		$i = 0;

		while($row = $result->fetch()) {
			$newsList[$i]['id'] = $row['id'];
			$newsList[$i]['title'] = $row['title'];
			$newsList[$i]['date'] = $row['date'];
			$newsList[$i]['short_content'] = $row['short_content'];
			$i++;
		}

		return $newsList;
	}
}
